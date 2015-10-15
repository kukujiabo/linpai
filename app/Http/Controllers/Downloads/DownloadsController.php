<?php namespace App\Http\Controllers\Downloads;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

    $order = ['order_code' => '123', 'created_at' => '2015-10-1 10:00:12' ];

    $user = ['mobile' => '15201932985', 'name' => 'Meroc' ];

    $data = [
    
      'order' => $order,

      'user' => $user,

      'receiver' => 'Ryan',

      'address' => 'asdomd1owid',
    
      'boun_code' => '3213',

      'good_name' => '上海临牌',

      'price' => '388',

      'num' => '1',

      'cut_fee' => '30',

      'final_fee' => '358',

      'car_num' => '沪123123'
    
    ];

    return view('order_pdf', $data);

  }

}
