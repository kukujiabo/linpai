<?php namespace App\Http\Controllers\Process;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Events\TriggerSms;
use App\Events\TiggerEmail;

class ProcessController extends Controller {

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

  public function getExpireorder (Request $request) 
  {
    $timestamp = time();

    $orderNum = Order::where('status', '=', 0)->count();

    $length = 1000;

    $pages = ceil($orderNum/1000);

    $interval = 2;

    for ($i = 0; $i < $pages; $i++) {

      $orders = Order::where('status', '=', 0)->take($i * 1000, $length)->get();

      foreach ($orders as $order) {

        $createdAt = strtotime($order->created_at.'');

        $time = ceil(($timestamp - $createdAt)/60);

        if ($time >= $interval) {

          $order->status = 3;

          $order->save();

        }

      }

    }

    return 'done';

  }

  public function getNotifyorderpayment(Request $request) 
  {

    $timestamp = time();

    $orderNum = Order::where('status', '=', 0)->count();

    $length = 1000;

    $pages = ceil($orderNum/1000);

    $interval = 2;

    for ($i = 0; $i < $pages; $i++) {

      $orders = Order::where('status', '=', 0)->take($i * 1000, $length)->get();

      foreach ($orders as $order) {

        $createdAt = strtotime($order->created_at.'');

        $time = ceil(($timestamp - $createdAt)/60);

        if ($time >= $interval) {

          $sms = event(new TriggerSms($order->order_owner_mobile, [
            
              'created_at' => $order->created_at,
            
              'order_code' => $order->order_code
            
            ])); 

          $mail = event(new TriggerEmal($order->order_owner_email, [
            
              'user' => $order->order_owner,

              'order_date' => $order->created_at,
            
              'order_code' => $order->order_code
            
            ]));



        }

      }

    }

    return 'done';
  
  }

}
