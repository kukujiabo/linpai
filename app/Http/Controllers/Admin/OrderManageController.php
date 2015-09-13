<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Good;
use App\Models\OrderAllInfo;
use Illuminate\Http\Request;
use App\Models\ReceiverInfo;

class OrderManageController extends Controller {

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

  public function getIndex (Request $request) 
  {

    $page = $request->input('page');

    $order_code = $request->input('order_code');

    $receiver = $request->input('receiver');

    $mobile = $request->input('mobile');

    $status = $request->input('status');

    $offset = 20;

    $pages = intval(ceil(OrderAllInfo::count()/$offset));

    $page = empty($page) ? 1 : $page > $pages ? $pages : $pages < 1 ? 1 : $page;

    $query = OrderAllInfo::where('order_code', '>', '1');

    if (!empty($order_code)) {

      $query->where('order_code', '=', $order_code);

    }

    if (!empty($receiver)) {

      $query->where('receiver', '=', $receiver);

    }

    if (!empty($mobile)) {

      $query->where('mobile', '=', $mobile);

    }

    if (is_numeric($status) && $status >= 0) {

      $query->where('status', '=', $status);

    }

    $orders = $query->skip(($page - 1) * $offset)

        ->take($offset)

        ->get();

    $data = [
    
      'pageName' => '订单管理',

      'orders' => $orders,

      'pages' => $pages,

      'current_page' => $page,

      'order_code' => empty($order_code) ? '' : $order_code,

      'receiver' => empty($receiver) ? '' : $receiver,

      'mobile' => empty($mobile) ? '' : $mobile,

      'status' => empty($status) ? '' : $status

    ];

    return view('/admin/order_board', $data);

  }

}
