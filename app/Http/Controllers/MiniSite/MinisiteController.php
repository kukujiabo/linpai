<?php namespace App\Http\Controllers\MiniSite;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderAllInfo;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

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

}
