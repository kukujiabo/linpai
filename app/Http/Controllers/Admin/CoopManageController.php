<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cooperators;
use Illuminate\Http\Request;

class CoopManageController extends Controller {

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

    $offset = 20;

    $pages = ceil(Cooperators::count()/$offset);

    $page = empty($page) ? 1 : $page > $pages ? $pages : $page < 1 ? 1 : $page;

    $coopers = Cooperators::skip(($page - 1) * $offset)

      ->take($offset)

      ->get();

    $data = [

      'cooperators' => $coopers,
    
      'pageName' => '合作伙伴',

      'current_page' => $page,

      'pages' => $pages
    
    ];

    return view('admin/coope_board', $data);

  }

}
