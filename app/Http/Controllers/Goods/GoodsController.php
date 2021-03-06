<?php namespace App\Http\Controllers\Goods;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\GoodAttribsInfo;
use Illuminate\Http\Request;
use Auth;

class GoodsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
    $goods = Good::orderBy('id', 'desc')->get();

    $gid = empty($request->input('gid')) ? $goods[0]->id : $request->input('gid');

    $goodInfos = array();

    foreach ($goods as $key => $good) {

      $goodInfo = GoodAttribsInfo::where('gid', '=', $good->id)

        ->where('acode', '=', 'price')
      
        ->first();

      $goodInfos[$key] = $goodInfo;

    }

    $data = array (
    
      'goods' => $goods,

      'gid' => $gid,

      'active' => 'active',

      'goodInfos' => $goodInfos,

      'is_select' => true,

      'wTitle' => '购买临牌'
    
    );

    return view('goods/detail', $data);
    
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

}
