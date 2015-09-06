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
use App\Events\TriggerBounGenerator;
use \Pingpp\Pingpp as Pingpp;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use App\Events\TriggerSms;
use App\User;


class OrdersController extends Controller {

  /*
   *
   */
  public function __construct ()
  {
    $this->middleware('auth');
  }

  /*
   * @return Response
   */
  public function getIndex(Request $request) 
  {

    $validate = Validator::make($request->input(), [
    
      'gid' => 'required',

      'num' => 'required|min:1'
    
    ]);

    if ($validate->fails()) {

      $failed = $validate->failed();

      $error = '';

      foreach ($failed as $key => $fail) {
      
        $error .= $this->orderindexerror($key);
      
      }
    
      //return redirect()->action('Goods\GoodsController@index', ['gid' => $request->input('gid')]);
    
    }

    $attribs = Attribute::all();

    $user = Auth::user();

    $gid = $request->input('gid');

    $num = $request->input('gnum');

    $good = Good::where('id', '=', $gid)->first();

    $bouns = Boun::where('uid', '=', $user->id)
      
      ->where('active', '=', 1)

      ->where('type', '=', 1)
      
      ->get();

    if ($good == null) {

      //todo return

    }

    $carsData = Car::where('uid', '=', $user->id)

      ->where('active', '=', 1)

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

    $citiesData = City::all();

    $districtsData = District::all();

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

    $cities = array();

    $districts = array();

    $receiverInfos = array();

    foreach ($citiesData as $city) {
      
      array_push($cities, $city);
    
    }

    foreach ($districtsData as $district) {
    
      array_push($districts, $district);
    
    }

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

      'good_attribs' => $attribs,

      'cities' => $cities,

      'districts' => $districts,

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

    $validate = Validator::make($request->input(), [
    
      'good' => 'required',

      'num' => 'required|min:1',

      'car' => 'required',

      'receiver' => 'required'

    ]);

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

    $data = [
    
      'reduction' => $reduction,

      'order' => $order,

      'orderPrice' => $op,

      'note' => $note,

      'good' => $good,

      'receiver' => $receiver,

      'pay_token' => $pay_token,

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

    $data = [
    
      'good' => $good,

      'orderPrice' => $orderPrice,

      'receiver' => $receiver,
      
      'order' => $order,

      'pay_token' => $pay_token,

      'is_pay' => true
    
    ];

    return view('orders/pay', $data);
  
  }

  public function postPayed (Request $request)
  {
    if (Session::get('pay_token') == $request->input('pay_token')) {

      return redirect('/home');

    } else {

      Session::put('pay_token', $request->input('pay_token'));

    }


    /*
     * 防止表单被重复提交
     */
    $user = Auth::user();

    $pay = $request->input('pay');

    $orderCode = $request->input('order_code');

    if (empty($pay)) {
    
      //return redirect('/order/pay');
    
    }

    /*
     * 订单
     */
    $order = Order::where ('code', '=', $orderCode)

      ->where('uid', '=', $user->id)

      ->where('active', '=', 1)

      ->first();

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
    $boun = event(new TriggerBounGenerator(Auth::user(), 'recommend'))[0];

    $sms = event(new TriggerSms($user->mobile, 'payed', ['order' => $order->code, 'boun' => $boun->code, 'fee' => $boun->note]));

    /*
     * pay success.
     *
     * 1.将订单状态置为已付款
     * 2.判断是否使用推荐码
     *
     */ 
    $order->status = 1;

    $order->save();

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
  
    return view('orders/pay_success', $data); 
  
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

      'num' => '<p>商品数量错误，商品数量必须大于1！</p>'
    
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

  /*
   * todo token
   */

}
