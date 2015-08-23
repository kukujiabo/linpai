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
use \Pingpp\Pingpp as Pingpp;
use Illuminate\Http\Request;
use Auth;
use Validator;


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

      ->get();

    $cars = array();

    foreach ($carsData as $car) {
    
      array_push($cars, $car);
    
    }

    $goodAttribsInfo = $this->getGoodAttributesInfo($gid);

    $citiesData = City::all();

    $districtsData = District::all();

    $receiverInfosData = ReceiverInfo::where('uid', '=', $user->id)
        
      ->where('active', '=', 1)

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

    foreach ($receiverInfosData as $receiverInfo) {
    
      array_push($receiverInfos, $receiverInfo);
    
    }

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

      'is_upload' => true

    ];

    return view('orders/orderInfo', $data); 

  }

  public function postPay(Request $request) 
  {
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

      'gid' => $params['good'],

      'num' => $params['num'], 

      'sum' => $gprice->value * $params['num'],

      'comment' => empty($params['comment']) ? null : $params['comment'],

      'status' => 0,

      'active' => 1
    
    ];

    //新建订单:
    $order = Order::create($newOrder);

    //检测优惠券是否可用
    $note = $this->measureDiscount($params); 

    $reduction = $note['reduction'];

    //订单详细信息
    $newOrderInfo = [
    
      'oid' => $order->id,

      'rid' => $params['receiver'],

      'cid' => $params['car'],

      'discount' => $reduction,

      'active' => 1
    
    ];

    //写入订单详细信息
    $oi = OrderInfo::create($newOrderInfo);

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
    
      OrderBoun::create([
      
        'oid' => $order->id,

        'uid' => $user->id,
      
        'bcode' => $boun,

        'success' => 1
      
      ]);
    
    }

    $good = Good::where('id', '=', $order->gid)->first();

    $receiver = ReceiverInfo::where('id', '=', $oi->rid)->first();

    $data = [
    
      'reduction' => $reduction,

      'order' => $order,

      'orderInfo' => $oi,

      'orderPrice' => $op,

      'note' => $note,

      'good' => $good,

      'receiver' => $receiver,

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

    $good = Good::where('id', '=', $order->gid)

          ->where('active', '=', 1)

          ->first();

    $orderPrice = OrderPrice::where('oid', '=', $order->id)

          ->where('active', '=', 1)

          ->first();

    $orderInfo = OrderInfo::where('oid', '=', $order->id)

          ->where('active', '=', 1)

          ->first();

    $receiver = ReceiverInfo::where('id', '=', $orderInfo->rid)

          ->where('active', '=', 1)

          ->first();

    $reduction = $orderPrice->cut_fee;

    $data = [
    
      'reduction' => $reduction,

      'good' => $good,

      'orderPrice' => $orderPrice,

      'orderInfo' => $orderInfo,

      'receiver' => $receiver,
      
      'order' => $order,

      'is_pay' => true
    
    ];

    return view('orders/pay', $data);
  
  }

  public function postPayed (Request $request)
  {
    $user = Auth::user();

    $pay = $request->input('pay');

    $orderCode = $request->input('order_code');

    if (empty($pay)) {
    
      return redirect()->back();
    
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
     * 订单信息
     */
    $orderInfo = OrderInfo::where('oid', '=', $order->id)

      ->where('active', '=', 1)

      ->first();
    
    /*
     * 订单价钱
     */
    $orderPrice = OrderPrice::where('oid', '=', $order->id)

      ->where('active', '=', 1)

      ->first();

    /*
     * 收货人信息
     */
    $receiver = ReceiverInfo::where('id', '=', $orderInfo->rid)

      ->where('active', '=', 1)

      ->first();
    
    
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
        
          $note += $boun->note;

   //       array_push($note['availableBouns'], $code]);
        
        }
      
      } else {
      
        array_push($note['failedBouns'], $code);

      }
    
    }

    return $note;

  }


}
