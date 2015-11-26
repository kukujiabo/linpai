<?php namespace App\Http\Controllers\MiniSite;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderAllInfo;
use App\Models\Attribute;
use App\Models\DeliverInfo;
use App\User;
use Validator;
use App\Models\Boun;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Session;
use Crypt;

class MinisiteController extends Controller {

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

  public function getLogin(Request $request) 
  {

    $user = Auth::user();

    if ($user) {
    
      return redirect('/mobile/profile');

    }

    $preUrl = Session::get('pre_url');

    $data = [
      
      'header' => '登录'
      
      ];

    if ($preUrl != null) {

      $data['pre_url'] = $preUrl;

      Session::forget('pre_url');
    
    }

    return view('mobile/login', $data);

  }

  public function getRegister(Request $request) 
  {

    $user = Auth::user();

    if ($user) {
    
      return redirect('/mobile/profile');
    
    }

    $data = [
      
      'header' => '用户注册',

      'user' => $user
       
      ];

    return view('mobile/register', $data);

  }

  public function getPassword (Request $request)
  {

    $data = [ 'header' => '重置密码' ];
  
    return view('mobile/password', $data); 
  
  }

  public function getMyorder ()
  {
    $user = Auth::user();

    if (empty($user->id)) {
    
      return redirect('/mobile/login');
    
    }
  
    $orders = OrderAllInfo::where('uid', '=', $user->id)
      
      ->orderBy('created_at', 'desc')
      
      ->get();

    $data = [
     
      'orders' => $orders,

      'header' => '我的订单'

     ];

    return view('mobile/order_list', $data);
  
  }

  public function getOrderinfo (Request $request) 
  {
     $order_code = $request->input('order');  

     if (empty($order_code) || strlen($order_code) == 0) {
     
      
     
     }
      
     $order = OrderAllInfo::where('order_code', '=', $order_code)->first();

     if (empty($order->oid)) {
     
     }

     $data = [ 'order' => $order, 'header' => '订单详情' ];
  
     return view('/mobile/order_detail', $data); 

  }

  public function getAddcar (Request $request) 
  {
     
    $attribs = Attribute::all();

    $carHand = $request->input('car_hand') == null ? 'one' : $request->input('car_hand');

    $goodCode = $request->input('good_code') == null ? 'below-three' : $request->input('good_code');

    $data = [

      'good_code' => $goodCode,
      
      'attribs' => $attribs,

      'car_hand' => $carHand,

      'header' => '新增车辆'
      
    ];
  
    return view('/mobile/add_car', $data);
  
  }

  public function getProvider (Request $request)
  {
  
    return view('/mobile/cooper'); 
  }

  public function getShare (Request $request) 
  {
    $mobileEncrypt = $request->input('user');

    /*
     * 没有手机号
     */
    if (empty($mobileEncrypt)) {
    
      return view('/mobile/about');
    
    }

    $mobile = Crypt::decrypt($mobileEncrypt);

    $user = User::where('mobile', '=', $mobile)->first();

    /*
     * 查找不到对应用户返回about
     */
    if (empty($user->id)) {
    
      return view('mobile/about');
    
    }

    $boun = Boun::where('uid', '=', $user->id)

      ->where('type', '=', 0)

      ->first();

    /*
     * 查找不到邀请码返回about
     */
    if (empty($boun->id)) {
    
      return view('mobile/share_code');
    
    }

    $data = [
      
        'name' => $user->name,

        'code' => $boun->code
      
      ];

    if (Auth::user() == null || $user->id != Auth::user()->id) {
    
      return view('mobile/share_code', $data);
    
    } else {
  
      return view('mobile/mycode', $data);

    }
  
  }

  public function getMyshare (Request $request)
  {
    $user = Auth::user();

    if (empty($user->id)) {
    
      return redirect('/mobile/login');
    
    }

    $username = Crypt::encrypt($user->mobile);

    $boun = Boun::where('uid', '=', $user->id)

      ->where('type', '=', 0)

      ->first();

    $url = "/mobile/share?user={$username}";
    
    return redirect($url);
    
  }

  public function getItems (Request $request)
  {

    $data = [
      
        'header' => '服务条款'
      
      ];
  
    return view('mobile/policy', $data);
  
  }

  public function getAddreceiver(Request $request)
  {
    $car_hand = $request->input('car_hand'); 

    $data = [
      
      'car_hand' => $car_hand,

      'header' => '添加联系人'
      
      ];
    
    return view('mobile/add_receiver', $data);
  
  }

  public function getProfile (Request $request)
  {
    $user = Auth::user();

    if (empty($user)) {
    
      return redirect('/moible/login');
    
    }

    $data = [
      
        'user' => $user,

        'header' => '个人中心'
      
      ];

  
    return view('mobile/profile', $data);
  
  }

  public function postLogout (Request $request)
  {
  
    $user = Auth::user();

    if (!empty($user)) {
    
      Auth::logout(); 
    
    }

    return redirect('/mobile/login');
  
  }
  

}
