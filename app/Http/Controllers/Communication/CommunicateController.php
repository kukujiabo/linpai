<?php namespace App\Http\Controllers\Communication;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cooperators;
use Illuminate\Http\Request;
use Validator;

class CommunicateController extends Controller {

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

  /*
   *
   */
  public function getCooperation (Request $request)
  {
    return view('coorperation/coope', ['wTitle' => '成为服务商']); 
  }

  public function postAddcooperator (Request $request) 
  {
    $validate = Validator::make($request->input(), [
    
      'contact' => 'required',

      'mobile' => 'required',

      'province' => 'required',

      'city' => 'required',

      'district' => 'required',

      'email' => 'required'
    
    ]);

    if ($validate->fails()) {
    
      $failed = $validate->failed();

      $message = array();
    
      foreach ($failed as $key => $value) {
      
        array_push($message, $key); 
      
      }

      return $this->failResponse($message);
    
    } else {
    
      $input = $request->input();

      unset($input['_token']);

      $res = Cooperators::create($input);

      return $this->successResponse('res', $res);
    
    
    }
  
  }

}
