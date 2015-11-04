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
  
    return view('intro/guide', [ 'wTitle' => '办理材料指南' ]);
  
  }

  public function getProblems (Request $request)
  {

    return view('intro/problems', [ 'wTitle' => '常见问题' ]);
  
  }

  public function getContact (Request $request)
  {
  
    return view('intro/contact', [ 'wTitle' => '联系我们' ]);
  
  }

  public function getBouninfo (Request $request)
  {

    return view('intro/boun_intro', [ 'wTitle' => '邀请码和优惠券' ]);

  }

  public function getAgreement (Request $request)
  {

    return view('intro/agreement', [ 'wTitle' => '使用协议' ]);

  }

}
