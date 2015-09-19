<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Advertise;

class AdvertiseManageController extends Controller {

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

    $type = $request->input('type');

    $code = $request->input('code');

    $offset = 20;

    $query = Advertise::where('id', '>', 0);

    if (!empty($type)) {

      $query->where('type', '=', $type);

    }

    if (!empty($code)) {

      $query->where('code', '=', $code);

    }

    $count = $query->count();

    $pages = $count/$offset;

    $page = empty($page) ? 1 : $page > $pages ? $pages : $page < 1 ? 1 : $page;

    $ads = $query->skip(($page - 1) * $offset)

      ->take($offset)

      ->get();
    
    $data = [

      'pageName' => '广告位管理',

      'current_page' => $page,

      'pages' => $pages,

      'ads' => $ads

    ];

    return view('admin/advertise_board', $data);

  }

}
