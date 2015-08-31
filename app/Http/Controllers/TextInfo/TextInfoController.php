<?php namespace App\Http\Controllers\TextInfo;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Storage;
use Illuminate\Http\Request;

class TextInfoController extends Controller {

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

  public function getUseagreement (Request $request) 
  {

    $tDisk = Storage::disk('text');

    $content = $tDisk->get('use_agreement.txt'); 

    $content = str_replace("\n", "<br>", $content);
     
    return $this->successResponse('text', $content); 
  
  }

  public function getBuyagreement (Request $request) 
  {

    $tDisk = Storage::disk('text');
  
    $content = $tDisk->get('use_agreement.txt');

    $content = str_replace("\n", "<br>", $content);

    return $this->successResponse("text", $content);
  
  }

  public function getMetaguide (Request $request)
  {
  
    return view('intro/guide');
  
  }

}
