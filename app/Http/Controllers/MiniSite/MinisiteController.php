<?php namespace App\Http\Controllers\MiniSite;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderAllInfo;
use App\User;
use Validator;
use App\Models\Boun;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
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

    return view('mobile/login');

  }

  public function getRegister(Request $request) 
  {

    return view('mobile/register');

  }

  public function getPassword (Request $request)
  {
  
    return view('mobile/password'); 
  
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

    $data = [ 'orders' => $orders ];

    return view('mobile/order_list', $data);
  
  }

  public function getOrderinfo (Request $request) 
  {
     $order_code = $request->input('order_code');  

     if (empty($order_code) || strlen($order_code) == 0) {
     
      
     
     }
      
     $order = OrderAllInfo::where('order_code', '=', $order_code)->first();

     if (empty($order->oid)) {
     
     }

     $data = [ 'order' => $order ];
  
     return view('/mobile/order_detail', $data); 

  }

  public function getAddcar (Request $request) 
  {
  
    return view('/mobile/add_car');
  
  }

  public function getProvider (Request $request)
  {
  
    return view('/mobile/cooper'); 
  }

  public function getShare (Request $request) 
  {

    $mobileEncrypt = $request->input('user');

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
    
      return view('mobile/about');
    
    }

    $data = [
      
        'name' => $user->name,

        'code' => $boun->code
      
      ];
  
    return view('mobile/share_code', $data);
  
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

    if (empty($boun->id)) {
    
    
    } else {

      $url = "/mobile/share?user={$username}";
    
      return redirect($url);
    
    }
  
  }

  public function getItems (Request $request)
  {
  
    return view('mobile/policy');
  
  }

}
