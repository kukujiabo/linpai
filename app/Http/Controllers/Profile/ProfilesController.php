<?php namespace App\Http\Controllers\Profile;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\VOrderInfos;
use App\Models\OrderAllInfo;
use App\Models\Car;
use App\Models\Province;
use App\Models\City;
use App\Models\Boun;
use App\Models\OrderPrices;
use App\User;
use App\Models\District;
use App\Models\DeliverInfo;
use App\Models\ReceiverInfo;
use App\Models\GoodAttribsInfo;
use App\Models\Attribute;
use App\Events\TriggerSms;
use App\Events\TriggerEmail;
use Auth;
use Validator;
use Hash;
use Crypt;


class ProfilesController extends Controller {

  public function __construct () 
  {
  
    $this->middleware('auth');
  
  }

  public function getIndex()
  {
  
    return view('profile/profile');
  
  }

  public function getMyorder(Request $request)
  {
    $page = !empty($request->input('page')) ? $request->input('page') : 1;

    $page = intval($page);

    $offset = 5;

    $user = Auth::user();

    $count = Order::where('uid', '=', $user->id)

      ->count();

    $pages = ceil($count/$offset);

    $page = $page > $pages ? $pages : $page;

    $orders = OrderAllInfo::where('uid', '=', $user->id)

      //->orderBy('status', 'asc')

      ->orderBy('created_at', 'desc')

      ->skip(($page - 1) * $offset)

      ->take($offset)

      ->get();

    /*
    $orders = array();

    foreach ($orderSet as $order) {
    
      array_push($orders, $order);
    
    }
     */

    $data = [
    
      'orders' => $orders,

      'page' => $page,

      'pages' => $pages,

      'orderActive' => true
    
    ];

    if ($request->ajax()) {
     
      $data['html'] = view('profile/order_list', $data) . '';//$this->orderListTemplate($orders);

      return $this->successResponse('res', $data);
    
    }

    return view('profile/myorder', $data);
  
  }

  public function getOrderdetail (Request $request) {

    $order_code = $request->input('order_code');

    $order = OrderAllInfo::where('order_code', '=', $order_code)->first();

    $deliver = DeliverInfo::where('order_code', '=', $order_code)->first();

    $data = [
    
      'order' => $order,

      'deliver' => $deliver
    
    ];

    if (!empty($order->order_code)) {

      return view('profile/order_detail', $data);

    } else {

      return view('profile/order_not_found');

    }

  }

  public function getCarinfo()
  {
    $user = Auth::user();

    $attributes = Attribute::where('spec', '=', 'file_upload')

      ->where('active', '=', 1)

      ->get();

    $carSet = Car::where('uid', '=', $user->id)

      ->where('active', '=', 1)

      ->orderBy('last_used', 'desc')

      ->orderBy('created_at', 'desc')

      ->get();

    $cars = array();

    foreach ($carSet as $car) {
    
      array_push($cars, $car);
    
    }

    $data = [

      'car_hand' => 'one',
    
      'good_attribs' => $attributes,

      'cars' => $cars,

      'carActive' => true
    
    ];

    return view('profile/carInfo', $data);

  }

  public function getAccount()
  {

    $user = Auth::user();
  
    $data = [
    
      'user' => $user,

      'accountActive' => true
    
    ];

    return view('profile/account', $data);
  
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

  public function getReceiverinfo (Request $request)
  {
    $user = Auth::user();

    $receiverInfoSet = ReceiverInfo::where('uid', '=', $user->id)

      ->where('active', '=', '1')

      ->orderBy('last_used', 'desc')

      ->orderBy('created_at', 'desc')

      ->get();

    $provinceSet = Province::all();      

    $provinces = array();

    foreach ($provinceSet as $province) {
    
      array_push($provinces, $province);
    
    }

    $cities = City::all();

    $districts = array();

    foreach ($cities as $city) {
    
      $district = District::where('city_code', '=', $city->code) 

        ->where('active', '=', '1')

        ->first();

      if ($district) {

        array_push($districts, $district);
    
      }

    }

    $receiverInfos = array();

    foreach ($receiverInfoSet as $receiverInfo) {
    
      array_push($receiverInfos, $receiverInfo);
    
    }

    $data = [
    
      'receiverInfos' => $receiverInfos,

      'provinces' => $provinces,

      'cities' => $cities,

      'districts' => $districts,

      'receiverActive' => true
    
    ];

    return view('profile/receiver_info', $data);
  
  }

  public function postUpdate (Request $request) 
  {
    $dataSet = $request->input();   

    $user = Auth::user();

    $insert = array ();

    !empty($dataSet['name']) ? $insert['name'] = $dataSet['name'] : null;

    !empty($dataSet['email']) ? $insert['email'] = $dataSet['email'] : null;

    $result = User::where('id', $user->id)

        ->update($insert);

    if ($result) {

      return $this->successResponse('result', $insert);

    } else {
    
      return $this->failResponse();
    
    }

  }

  public function getMybouns (Request $request) 
  {
    $selectedtab = empty($request->input('type')) ? 'rec' : $request->input('type');
    
    $user = Auth::user();

    $bouns = Boun::where('uid', '=', $user->id)

      ->where('active', '=', 1)

      ->where('type', '=', 1)

      ->get();

    $recomend = Boun::where('uid', '=', $user->id)

      ->where('active', '=', 1)

      ->where('type', '=', 0)

      ->first();

    $data = [
    
      'bouns' => $bouns,
    
      'recomend' => $recomend,

      'type' => $selectedtab,

      'bounsActive' => true
    
    ];
  
    return view('profile/mybouns', $data);
  
  }

  private function orderListTemplate ($dataSet) 
  {
    $html = '';

    foreach ($dataSet as $data) {

      $status;
     
      if ($data->status == 0) {

        $status = "<a href=\"/order/pay?order={$data->order_code}\" class=\"require go_to_pay\" data-id=\"{$data->oid}\">未付款</a>";
      } else if ($data->status == 1) {

        $status = "已付款<div><a href=\"#\" class=\"require\" data-id=\"{$data->oid}\">查看物流</a></div>";

      } else if ($data->status == 2) {

        $status = "已完成";

      } else {

        $status = "已关闭";

      }

      $html .= "<div class=\"order-title\">"
    
        . "<div class=\"col-xs-4\">"

        . "<b>编号：{$data->order_code} </b>"

        . "</div>"

        . "<div class=\"col-xs-4\">"

        . "<b>{$data->created_at}</b>"

        . "</div>"

        . "<div style=\"clear:both;\"></div>"

        . "</div>"

        . "<div class=\"order-body\">"

        . "<div class=\"col-xs-3 no-padding\">"

        . "<div class=\"col-xs-4 no-padding\" style=\"background:#eee;\">"

        . "<img src=\"{$data->good_tiny_pic}\">"

        . "</div>"

        . "<div class=\"col-xs-8 order-col\">"

        . $data->good_name

        . "</div>"

        . "</div>"

        . "<div class=\"col-xs-2 order-col\">"

        . ($data->sum/$data->num)

        . "</div>"

        . "<div class=\"col-xs-1 order-col\">"

        . $data->num

        . "</div>"

        . "<div class=\"col-xs-1 order-col\">"

        . $data->cut_fee

        . "</div>"

        . "<div class=\"col-xs-2 order-col\">"

        . $data->final_price

        . "</div>"

        . "<div class=\"col-xs-1 order-col\">"

        . $status

        . "</div>"

        . "<div class=\"col-xs-2 order-col\">"
        
        . "上海"

        . "</div>"

        . "<div style=\"clear:both\"></div>"

        . "</div>";
    
    }

    return $html;
  
  }

  public function postPasswd (Request $request)
  {
    $authUser = Auth::user();

    $user = User::find($authUser->id);

    $validate = Validator::make($request->input(), [
    
      'oldpassword' => 'required',

      'newpassword' => 'required'
    
    ]);

    if ($validate->fails()) {

      $failed = [];

      foreach ($validate->failed() as $key => $fail) {

        array_push($failed, $key);

      }

      return $this->failResponse($failed);
    
    }

    $oldpassword = $request->input('oldpassword');
  
    $newpassword = $request->input('newpassword'); 


    /*
    if ($confirmpassword != $newpassword) {

      return $this->failResponse('not_match');

    }
     */

    /*
     * 查询原密码
     */
    if (!Auth::validate(['mobile' => $user->mobile, 'password' => $oldpassword])) {

      return $this->failResponse('miss_match');

    }

    $user->password = bcrypt($newpassword);

    $res = $user->save();

    if ($res) {

      Auth::logout();

      return $this->successResponse('res', [$res, $user->password, bcrypt($oldpassword)]);

    } else {

      return $this->failResponse('sys_err');
    
    }
  
  }

  public function batchInvite (Request $request) 
  {
    $list = $request->input('list');

    //$array = explode(

  }

  public function getDeliverinfo (Request $request)
  {
    $order_code = $request->input('order_code');

    if (empty($order_code)) {

      return $this->failResponse('empty');

    }

    $info = DeliverInfo::where('order_code', '=', $order_code)->first();

    if (empty($info->id)) {

      return $this->failResponse('not_found');

    }

    $order = Order::where('code', '=', $order_code)->first();

    $result = [
    
      'deliver_code' => $info->code,

      'company' => $info->company,

      'plate_number' => $order->plate_number
    
    ];

    return $this->successResponse('result', $result);

  }

  public function postInvite(Request $request) 
  {
    $shares = $request->input('shares'); 

    $shares = str_replace("\n", " ", $shares);


    if (empty($shares)) {

      return $this->failResponse('empty');

    }

    $arr = explode(' ', $shares); 

    if (!count($arr)) {

      return $this->failResponse('invalid');

    }

    $user = Auth::user();

    $boun = Boun::where('uid', '=', $user->id)

      ->where('active', '=', 1)

      ->first();

    if (empty($boun->id)) {

      return $this->failResponse('not_found');

    }

    $info = [ 'friend' => $user->name, 'recommend' => $boun->code ];

    $illegal = array();

    $sent = array();

    foreach ($arr as $val) {

      /*
       * 手机号
       */
      if (is_numeric($val) && strlen($val) == 11) {

        $res = event(new TriggerSms($val, 'invite', $info));

        array_push($sent, $val);

        continue;

      } else if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
        /*
         * 邮箱
         */

        $res = event(new TriggerEmail($val, 'invite', $info));

        array_push($sent, $val);

        continue;

      }

      array_push($illegal, $val);

    }

    return $this->successResponse('result', [ 'illegal' => $illegal, 'sent' => $sent ]);
  
  }

}
