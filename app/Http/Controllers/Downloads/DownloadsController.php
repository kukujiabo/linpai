<?php namespace App\Http\Controllers\Downloads;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderAllInfo;
use App\Models\Boun;
use Illuminate\Http\Request;

class DownloadsController extends Controller {

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
    $file = $request->input('file');

    $path = '';

    if (file_exists($path = storage_path() . '/app/uploads/tmps/' . $file)) {

      return response()->download($path);

    }

  }

  public function getOrderpdf (Request $request) 
  {

    $oid = $request->input('oid');

    $order = OrderAllInfo::where('order_code', '=', $oid)->first();

    if (empty($order) || count($order) == 0) {

      return 'fail';

    }

    $boun = Boun::where('uid', '=', $order->uid)

      ->where('type', '=', 0)

      ->first();

    $data = [
    
      'order_code' => $order->order_code,

      'mobile' => $order->mobile,

      'user' => $order->order_owner,

      'created_at' => $order->created_at,

      'receiver' => $order->receiver,

      'address' => $order->city . $order->district . $order->address,
    
      'boun_code' => $boun->code,

      'good_name' => $order->good_name,

      'price' => $order->g_single_price,

      'num' => $order->num,

      'cut_fee' => $order->cut_fee,

      'final_fee' => $order->final_price,

      'car_num' => $order->plate_number
    
    ];

    return view('order_pdf', $data);

  }

}
