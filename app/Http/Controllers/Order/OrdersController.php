<?php namespace app\http\controllers\order; 

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\OrderBoun;
use App\Models\OrderPrice;
use App\Models\City;
use App\Models\Car;
use App\Models\Boun;
use App\Models\District;
use App\Models\ReceiverInfo;
use App\Models\GoodAttribsInfo;
use App\Models\Attribute;
use App\Models\OrderAllInfo;
use App\Events\TriggerBounGenerator;
use \Pingpp\Pingpp as Pingpp;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Events\TriggerSms;
use App\Events\TriggerEmail;
use App\User;
use App\Models\PayCheck;
use App\Models\Bank;

class OrdersController extends Controller {

  /*
   *
   */
  public function __construct ()
  {
    $this->middleware('auth', [ 'except' => ['postPaynotify']]);
  }

  /*
   * @return Response
   */
  public function getIndex(Request $request) 
  {

    $validate = Validator::make($request->input(), [
    
      'gid' => 'required',

      'num' => 'required|min:1',

      'car_hand' => 'required'
    
    ]);

    $carHand = $request->input('car_hand');

    if ($validate->fails()) {

      $failed = $validate->failed();

      $error = '';

      foreach ($failed as $key => $fail) {
      
        $error .= $this->orderindexerror($key);
      
      }
    
    }

    $attribs = Attribute::all();

    $user = Auth::user();

    $gid = $request->input('gid');

    $num = $request->input('gnum');

    $good = Good::where('id', '=', $gid)->first();

    if ($good->code == 'below-three') {

      return redirect('/goods');

    }

    $bouns = Boun::where('uid', '=', $user->id)
      
      ->where('active', '=', 1)

      ->where('type', '=', 1)
      
      ->get();

    if ($good == null) {

      //todo return

    }

    $carsData = Car::where('uid', '=', $user->id)

      ->where('active', '=', 1)

      ->where('car_hand', '=', $carHand)

      ->orderBy('last_used', 'desc')

      ->get();

    $cars = array();

    $defaultCar = null;

    foreach ($carsData as $car) {

      if ($car->last_used) {
      
        $defaultCar = $car;
      
      }
    
      array_push($cars, $car);
    
    }

    $goodAttribsInfo = $this->getGoodAttributesInfo($gid);

    //$citiesData = City::all();

    //$districtsData = District::all();

    $receiverInfosData = ReceiverInfo::where('uid', '=', $user->id)
        
      ->where('active', '=', 1)

      ->orderBy('last_used', 'desc')

      ->get();

    $price = 0;

    foreach ($goodAttribsInfo as $info) {
    
      if ($info->acode == 'price') {
      
        $price = $info->value;
      
      }
    
    }

    //$cities = array();

    //$districts = array();

    $receiverInfos = array();

    $defaultReceiver = null;

    foreach ($receiverInfosData as $receiverInfo) {
    
      array_push($receiverInfos, $receiverInfo);

      if ($receiverInfo->last_used) {
      
        $defaultReceiver = $receiverInfo;
      
      }
    
    }

    $formCode = md5(time());


    $data = [

      'good' => $good,

      'num' => $num,

      'car_hand' => $carHand,

      'good_attribs' => $attribs,

      'car_hand' => $carHand,

      //'cities' => $cities,

      //'districts' => $districts,

      'receiverInfos' => $receiverInfos,

      'cars' => $cars,

      'single_price' => $price,

      'price' => $price * $num,

      'bouns' => $bouns,

      'formCode' => $formCode,

      'is_upload' => true,

      'defaultCar' => $defaultCar,

      'defaultReceiver' => $defaultReceiver

    ];

    return view('orders/orderInfo', $data); 

  }

  public function postPay(Request $request) 
  {
    /*
     * 防止表单重复提交
     * 
     * Session 存入表单令牌
     */
    if (Session::get('order_submit') == $request->input('form_code')) {
    
      return redirect('/order/pay?order=' . Session::get('order_code'));
    
    } else {

      Session::put('order_submit', $request->input('form_code'));
    
    }
    
    $user = Auth::user();

    $carHand = $request->input('car_hand');

    $required = null;

    if ($carHand == 'one') {

      $required = array (
      
        'good' => 'required',

        'num' => 'required|min:1',

        'car' => 'required',

        'receiver' => 'required'
      
      );

    } elseif ($carHand == 'second') {

      $required = array (
      
        'good' => 'required',

        'num' => 'required|min:1',

        'receiver' => 'required'
      
      );

    }

    $validate = Validator::make($request->input(), $required);

    if ($validate->fails()) {
    
      $failed = $validate->failed();
    
      return redirect()->back();
    
    }

    //获取输入参数
    $params = $request->input();

    //获取商品价格
    $gprice = GoodAttribsInfo::where('gid', '=', $params['good'])    

            ->where('acode', '=', 'price')

            ->first();

    //订单 
    $newOrder = [
    
      'code' => $this->generateOrderCode($user->id),

      'uid' => $user->id,

      'rid' => $params['receiver'],

      'cid' => $params['car'],

      'gid' => $params['good'],

      'num' => $params['num'], 

      'sum' => $gprice->value * $params['num'],

      'comment' => empty($params['comment']) ? null : $params['comment'],

      'status' => 0,

      'active' => 1
    
    ];

    //新建订单:
    $order = Order::create($newOrder);

    //记录用户选择的车型
    $car = Car::where('uid', '=', $user->id)

      ->where('last_used', '=', 1)

      ->where('active', '=', 1)

      ->first();

    if (!empty($car->id) && ($car->id != $params['car'])) {
    
      $car->last_used = 0;

      $car->save();
      
    }

    Car::where('id', '=', $params['car'])

      ->where('active', '=', 1)

      ->update(['last_used' => 1]);

    //记录用户选择的收货地址
    $receiver = ReceiverInfo::where('uid', '=', $user->id)

      ->where('last_used', '=', 1)

      ->where('active', '=', 1)

      ->first();

    if (!empty($receiver->id) && ($receiver->id != $params['receiver'])) {

      $receiver->last_used = 0;

      $receiver->save();

    }

    ReceiverInfo::where('id', '=', $params['receiver'])

      ->where('active', '=', 1)

      ->update(['last_used' => 1]);

    Session::put('order_code', $order->code);

    //检测优惠券是否可用
    $note = $this->measureDiscount($params); 

    $reduction = $note['reduction'];

    //订单最终价格
    $extraFee = 0;

    $orderPrices = [
    
      'oid' => $order->id,

      'orig_price' => $order->sum,

      'cut_fee' => $reduction,

      'extra_fee' => $extraFee,

      'final_price' => ($order->sum - $reduction + $extraFee),

      'active' => 1
    
    ];

    $op = OrderPrice::create($orderPrices);

    //记录优惠券使用信息
    foreach ($note['availableBouns'] as $boun) {

      $bobj = Boun::where('code', '=', $boun)

        ->where('active', '=', 1)

        ->first();

      if (!empty($bobj)) {
    
        OrderBoun::create([
        
          'oid' => $order->id,

          'uid' => $user->id,
        
          'bcode' => $boun,

          'btype' => $bobj->type,

          'rewarded' => 0,

          'success' => 0,

          'owner_id' => $bobj->uid
        
        ]);

      }
    
    }

    $good = Good::where('id', '=', $order->gid)->first();

    $receiver = ReceiverInfo::where('id', '=', $order->rid)->first();

    $pay_token = md5($order->id . time());

    $banks = Bank::all();

    $data = [
    
      'reduction' => $reduction,

      'order' => $order,

      'orderPrice' => $op,

      'note' => $note,

      'good' => $good,

      'receiver' => $receiver,

      'pay_token' => $pay_token,

      'banks' => $banks,

      'is_pay' => true
    
    ];

    return view('orders/pay', $data);
  
  }

  public function getPay (Request $request) 
  {
    $ocode = $request->input('order');

    if (empty($ocode)) {
    
      return redirect()->back();
    
    }

    $order = Order::where('code', '=', $ocode)

      ->where('status', '=', 0)

      ->where('active', '=', 1)

      ->first();

    /*
     * 订单不存在或已经支付过了。
     */
    if (empty($order->id)) {

      return redirect('/home');

    }

    $good = Good::where('id', '=', $order->gid)

          ->where('active', '=', 1)

          ->first();

    $orderPrice = OrderPrice::where('oid', '=', $order->id)

          ->where('active', '=', 1)

          ->first();

    $orderInfo = OrderInfo::where('oid', '=', $order->id)

          ->where('active', '=', 1)

          ->first();

    $receiver = ReceiverInfo::where('id', '=', $order->rid)

          ->where('active', '=', 1)

          ->first();

    $reduction = $orderPrice->cut_fee;

    $pay_token = md5($order->id . time());

    $banks = Bank::all();

    $data = [
    
      'good' => $good,

      'orderPrice' => $orderPrice,

      'receiver' => $receiver,
      
      'order' => $order,

      'pay_token' => $pay_token,

      'banks' => $banks,

      'is_pay' => true
    
    ];

    if (!empty(Session::get('pay_omit'))) {

      $data['pay_omit'] = true;

      Session::forget('pay_omit');

    }

    if (!empty(Session::get('bank_omit'))) {

      $data['bank_omit'] = true;

      Session::forget('bank_omit');

    }
    
    return view('orders/pay', $data);
  
  }

  public function postPaying (Request $request)    
  {
    if (Session::get('pay_token') == $request->input('pay_token')) {

      return redirect('/home');

    } else {

      Session::put('pay_token', $request->input('pay_token'));

    }

    $order = Order::where('code', '=', $request->input('order_code'))->first();

    if (empty($order)) {

      return redirect('/home');

    }

    if ($order->status > 0) {

      //todo payed
      return redirect('/home');

    } else if ($order->active == 0) {

      //todo order closed.
      return redirect('/home');

    }

    if (empty($request->input('pay'))) {

      Session::put('pay_omit', true);

      return redirect('/order/pay?ordedr=' . $order->code);

    }

    $good = Good::find($order->gid);

    $orderPrice = OrderPrice::where('oid', '=', $order->id)->first();

    require_once('lib/alipay_submit.class.php');

    switch ($request->input('pay')) {

      case 'zhifubao':

        return $this->alipay($order, $good, $orderPrice);

      case 'union':

        $bank = $request->input('bank');

        if (empty($bank)) {

          Session::put('bank_omit', true);

          return redirect('/order/pay?order=' . $order->code);

        }

        return $this->creditpay($order, $good, $orderPrice, $bank);

      default :

        break;

    }

  }

  private function alipay ($order, $good, $orderPrice)
  {
    $alipay_config = $this->payConfig();
  
    //支付类型
    $payment_type = "1";

    //服务器异步通知路径
    //$notify_url = "http://www.51linpai.com:8000/order/paynotify";

    //页面跳转同步通知页面路径
    $return_url = "http://www.51linpai.com:8000/order/payed";

    //商户网站订单系统中唯一订单号
    $out_trade_no = $order->code;

    //订单名称
    $subject = $good->name . ' * ' . $order->num;

    //订单金额
    $total_fee = $orderPrice->final_price;

    //订单描述
    $body = '测试订单描述';

    //商品展示地址
    $show_url = "http://www.51linpai.com:8000/goods?gid={$good->id}";

    //客户端ip地址
    $exter_invoke_ip = $_SERVER['REMOTE_ADDR'];

    $parameter = array(
       "service" => "create_direct_pay_by_user",
       "partner" => trim($alipay_config['partner']),
       "seller_email" => trim($alipay_config['seller_email']),
       "payment_type"  => $payment_type,
       //"notify_url"  => $notify_url,
       "return_url"  => $return_url,
       "out_trade_no"  => $out_trade_no,
       "subject" => $subject,
       "total_fee" => $total_fee,
       "body"  => $body,
       "show_url"  => $show_url,
       "exter_invoke_ip" => $exter_invoke_ip,
       "_input_charset"  => trim(strtolower($alipay_config['input_charset']))
     );


    $alipaySubmit = new \AlipaySubmit($alipay_config);

    $parameter['anti_phishing_key'] = $alipaySubmit->query_timestamp();

    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "正在跳转到支付宝...");

    return $html_text; 
  
  }

  private function creditpay ($order, $good, $orderPrice, $bank) 
  {
    $alipay_config = $this->payConfig();
  
    $payment_type = 1;

    //$notify_url = "http://www.51linpai.com:8000/order/paynotify";

    //页面跳转同步通知页面路径
    $return_url = "http://www.51linpai.com:8000/order/payed";

    //商户网站订单系统中唯一订单号
    $out_trade_no = $order->code;

    //订单名称
    $subject = $good->name . ' * ' . $order->num;

    //订单金额
    $total_fee = $orderPrice->final_price;

    //订单描述
    $body = '测试订单描述';

    //商品展示地址
    $show_url = "http://www.51linpai.com:8000/goods?gid={$good->id}";

    //支付方式
    $paymethod = "bankPay";

    //默认网银
    $defaultbank = $bank;

    //客户端ip地址
    $exter_invoke_ip = $_SERVER['REMOTE_ADDR'];

    $parameter = array(
       "service" => "create_direct_pay_by_user",
       "partner" => trim($alipay_config['partner']),
       "seller_email" => trim($alipay_config['seller_email']),
       "payment_type"  => $payment_type,
       //"notify_url"  => $notify_url,
       "return_url"  => $return_url,
       "out_trade_no"  => $out_trade_no,
       "subject" => $subject,
       "total_fee" => $total_fee,
       "body"  => $body,
       "show_url"  => $show_url,
       "paymethod" => $paymethod,
       "defaultbank" => $defaultbank,
       "exter_invoke_ip" => $exter_invoke_ip,
       "_input_charset"  => trim(strtolower($alipay_config['input_charset']))
     );

    $alipaySubmit = new \AlipaySubmit($alipay_config);

    $parameter['anti_phishing_key'] = $alipaySubmit->query_timestamp();

    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "<h2>正在跳转到支付页面...</h2>");

    return $html_text; 
  
  }

  /*
   * 跳转异步通知页面
   */
  public function postPaynotifyx (Request $request) {

    require_once('alipay_config.php');

    require_once('lib/alipay_notify.class.php');

    $alipayNotify = new \AlipayNotify($this->payConfig());

    $verifyResult = $alipayNotify->verifyReturn();

    $order = null;

    $user = null;

    //支付成功
    if ($verifyResult) {

      $orderCode = $_POST['out_trade_no'];

      $trade_no = $_POST['trade_no'];

      $trade_status = $_POST['trade_status'];

      if($trade_status == 'TRADE_FINISHED') {
      
        //判断该笔订单是否在商户网站中已经做过处理
        //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
        //如果有做过处理，不执行商户的业务程序
      
      } elseif ($_GET['trade_status'] == 'TRADE_SUCCESS') {
         
         /*
          * 获取订单
          */
        $order = Order::where('code', '=', $orderCode)->first();

        if (empty($order->id)) {

           //todo
           //return view();  

        }

         /*
          * 如果订单已经支付过
          */
        if (!$order->status) {

           /*
            * 创建支付凭据
            */
           PayCheck::create([
           
             'out_trade_no' => $orderCode,

             'trade_no' => $trade_no,
           
             'trade_status' => $trade_status
           
           ]);

           /*
            * 修改订单状态
            */
           $order->status = 1;

           $order->save();

        }

        /*
         * 获取下单用户
         */
        $user = User::find($order->uid);

        /*
         * 订单优惠券
         */
        $orderBouns = OrderBoun::where('oid', '=', $order->id) 

          ->where('uid', '=', $user->id)

          ->where('success', 'is', 'null')

          ->get();
        
        
        /*
         * 订单价钱
         */
        $orderPrice = OrderPrice::where('oid', '=', $order->id)

          ->where('active', '=', 1)

          ->first();

        /*
         * 收货人信息
         */
        $receiver = ReceiverInfo::where('id', '=', $order->rid)

          ->where('active', '=', 1)

          ->first();

        /*
         * todo pay.
         */
        
        /*
         * 发送订单确认短信
         * 1.查询用户是否有推荐码，如果没有，则生成
         * 2.发送短信 订单号，推荐码，抵扣费用
         */
        $boun = event(new TriggerBounGenerator($user, 'recommend'))[0];

        //短信
        $sms = event(new TriggerSms($user->mobile, 'payed', [
          
          'order_code' => $order->code, 
          
          'boun' => $boun->code, 
          
          'fee' => $boun->note
        
        ]));

        //邮件
        $mail = event(new TriggerEmail($user->email, 'payed', [ 
          
          'order_code' => $order->code, 
          
          'recommend' => $boun->code,

          'order_date' => $order->created_at
        
        ]));

        /*
         * pay success.
         *
         * 1.将订单状态置为已付款
         * 2.判断是否使用推荐码
         *
         */ 
        foreach ($orderBouns as $orderBoun) {

          $orderBoun->success = 1;

          $orderBoun->save();
        
          if ($orderBoun->btype == 0) {
          
            /*
             * 如果是推荐码.
             */
            $friend = User::find($orderBoun->owner_id);

            if (!empty($friend->id)) {
              /*
               * 触发短信
               */
              event(new TriggerSms($friend->mobile, 'friend_use'));

              /*
               * 触发邮件
               */
              event(new TriggerEmail($friend->email, 'friend_use', [ 'friend' => $user->name ]));

            }

            $bCount = OrderBoun::where('bcode', '=', $orderBoun->bcode)

              ->where('rewarded', '=', 0)

              ->where('success', '=', 1)

              ->count();

            if ($bCount >= 1) {

              /*
               * 成功使用次数达到10张，赠送一张优惠券
               */
              Boun::create([
              
                'note' => 30,

                'type' => 1,

                'uid' => $orderBoun->owner_id,
                
                'code' => Boun::generateOrderCode(),

                'active' => 1
              
              ]);
            
              OrderBoun::where('bcode', '=', $orderBoun->bcode)

                ->where('rewarded', '=', 0)

                ->update(['rewarded' => 1]);
            
            }
          
          } else {
            
            /*
             * 如果是优惠码.
             */
            Boun::where('code', '=', $orderBoun) 

              ->where('uid', '=', $user->id)

              ->update(['active' => 0]);
          
          }
        
        }

        echo "success";

      } else {

          //todo 支付未完成！
        echo "fail";

      }

    }

  }


  public function getPayed (Request $request)
  {
    require_once('lib/alipay_notify.class.php');

    $alipayNotify = new \AlipayNotify($this->payConfig());

    $verifyResult = $alipayNotify->verifyReturn();

    $order = null;

    $user = null;

    if ($verifyResult) {

      $orderCode = $_GET['out_trade_no'];

      $trade_no = $_GET['trade_no'];

      $trade_status = $_GET['trade_status'];

     if($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
      //判断该笔订单是否在商户网站中已经做过处理
      //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
      //如果有做过处理，不执行商户的业务程序
       
       /*
        * 获取订单
        */
       $order = Order::where('code', '=', $orderCode)->first();

       if (empty($order->id)) {

         //todo
         //return view();  

       }

       /*
        * 如果订单已经支付过
        */
       if (!$order->status) {

         /*
          * 创建支付凭据
          */
         PayCheck::create([
         
           'out_trade_no' => $orderCode,

           'trade_no' => $trade_no,
         
           'trade_status' => $trade_status
         
         ]);

         /*
          * 修改订单状态
          */
         $order->status = 1;

         $order->save();

       }


        /*
         * 获取下单用户
         */
        $user = User::find($order->uid);

        if (Auth::user() == null) {

          Auth::loginUsingId($user->id); 

          Session::regenerate();

        }

        /*
         * 订单优惠券
         */
        $orderBouns = OrderBoun::where('oid', '=', $order->id) 

          ->where('uid', '=', $user->id)

          ->where('success', 'is', 'null')

          ->get();
        
        /*
         * 订单价钱
         */
        $orderPrice = OrderPrice::where('oid', '=', $order->id)

          ->where('active', '=', 1)

          ->first();

        /*
         * 收货人信息
         */
        $receiver = ReceiverInfo::where('id', '=', $order->rid)

          ->where('active', '=', 1)

          ->first();

        /*
         * todo pay.
         */
        
        /*
         * 发送订单确认短信
         * 1.查询用户是否有推荐码，如果没有，则生成
         * 2.发送短信 订单号，推荐码，抵扣费用
         */
        $boun = event(new TriggerBounGenerator($user, 'recommend'))[0];

        $sms = event(new TriggerSms($user->mobile, 'payed', [
          
          'order_code' => $order->code, 
          
          'boun' => $boun->code, 
          
          'fee' => $boun->note
        
        ]));

        $mail = event(new TriggerEmail($user->email, 'payed', [ 
          
          'order_code' => $order->code, 
          
          'recommend' => $boun->code,

          'order_date' => $order->created_at
        
        ]));

        /*
         * pay success.
         *
         * 1.将订单状态置为已付款
         * 2.判断是否使用推荐码
         *
         */ 
        foreach ($orderBouns as $orderBoun) {

          $orderBoun->success = 1;

          $orderBoun->save();
        
          if ($orderBoun->btype == 0) {
          
            /*
             * 如果是推荐码.
             */
            $friend = User::find($orderBoun->owner_id);

            if (!empty($friend->id)) {
              /*
               * 触发短信
               */
              event(new TriggerSms($friend->mobile, 'friend_use'));

              /*
               * 触发邮件
               */
              event(new TriggerEmail($friend->email, 'friend_use', [ 'friend' => $user->name ]));

            }

            $bCount = OrderBoun::where('bcode', '=', $orderBoun->bcode)

              ->where('rewarded', '=', 0)

              ->where('success', '=', 1)

              ->count();

            if ($bCount >= 1) {

              /*
               * 成功使用次数达到10张，赠送一张优惠券
               */
              Boun::create([
              
                'note' => 30,

                'type' => 1,

                'uid' => $orderBoun->owner_id,
                
                'code' => Boun::generateOrderCode(),

                'active' => 1
              
              ]);
            
              OrderBoun::where('bcode', '=', $orderBoun->bcode)

                ->where('rewarded', '=', 0)

                ->update(['rewarded' => 1]);
            
            }
          
          
          } else {
            
            /*
             * 如果是优惠码.
             */
            Boun::where('code', '=', $orderBoun) 

              ->where('uid', '=', $user->id)

              ->update(['active' => 0]);
          
          }
        
        }

        $data = [
        
          'is_deliver' => true,

          'receiverInfos' => $receiver,

          'orderPrice' => $orderPrice,

          'user' => $user,

          'order' => $order

        ];

        //var_dump($request->cookie('51_linpai'));

        return view('orders/pay_success', $data); 

      } else {

        return "fail";

      }

    } else {

      return redirect('/home');

    }
  
  }

  /*
   *
   */
  public function getPaysuccess()
  {
  
    return view('orders/pay_success');
  
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

  /*
   * 
   *
   * @return string
   */
  private function orderCode($uid, $gid) 
  {
    $time = time();

    $code = md5($uid . $gid . $time);

    return $code;
  
  }

  private function getGoodAttributesInfo ($gid) 
  {
    $goodAttributes = GoodAttribsInfo::where('gid', '=', $gid)->get();

    return $goodAttributes; 

  }

  private function orderindexerror ($key)
  {
    $fields = array (
    
      'gid' => '<p>商品选择错误，请返回首页重新选择！</p>',

      'num' => '<p>商品数量错误，商品数量必须大于1！</p>',

      'car_hand' => '<p>请选择车辆类型：新车／二手车</p>'
    
    );

    return $fields[$key];
  
  }

  private function generateOrderCode ($uid) 
  {
    return rand(10, 99).time().$uid.rand(10,99);
  }

  private function measureDiscount($array)
  {
    $discount = array(); 

    $note = array(
    
      'reduction' => 0,

      'availableBouns' => array(),

      'failedBouns' => array()
    
    );

    $user = Auth::user();
  
    if (!empty($array['youhui_1'])) {

      array_push($discount, $array['youhui_1']);
    
    }

    if (!empty($array['youhui_2'])) {

      array_push($discount, $array['youhui_2']);
    
    }
  
    if (!empty($array['youhui_3'])) {

      array_push($discount, $array['youhui_3']);
    
    }

    if (empty($discount)) {
    
      return $note;
    
    }

    foreach ($discount as $code) {
    
      $boun = Boun::where('code', '=', $code)->first();
    
      if ($boun->active) {
      
        if ($boun->type) {
        
          if ($boun->uid == $user->id) {
          
            $note['reduction'] += $boun->note;

            array_push($note['availableBouns'], $code);
          
          } else {
          
            array_push($note['failedBouns'], $code);
          
          }

        } else {
        
          $note['reduction'] += $boun->note;

          array_push($note['availableBouns'], $code);
        
        }
      
      } else {
      
        array_push($note['failedBouns'], $code);

      }
    
    }

    return $note;

  }


  private function payConfig () 
  {

    $alipay_config = array();
  
    $alipay_config['partner'] = '2088021237428966';

    $alipay_config['seller_email'] = 'linpai51@foxmail.com';

    $alipay_config['key'] = 'g0cezbipn4glrjbakg89n898j5a6qhbt';

    $alipay_config['sign_type'] = strtoupper('MD5');

    $alipay_config['input_charset'] = 'utf-8';

    $alipay_config['cacert'] = getcwd() . '\\cacert.pem';

    $alipay_config['transport'] = 'http';
  
    return $alipay_config; 
  
  }

  /*
   * todo token
   */

  public function getCheckpayed (Request $request) 
  {
    $order = $request->input('order');

    if (empty($order)) {

      return $this->failResponse('empty_code');

    }

    $result = OrderAllInfo::where('order_code', '=', $order)->first();

    if (empty($result->id)) {

      return $this->failResponse('not_found');

    }
      
    if ($result->status > 0) {

      return $this->successResponse();

    } else {

      return $this->failResponse('not_pay');

    }

  }


}
