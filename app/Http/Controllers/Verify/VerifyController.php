<?php namespace App\Http\Controllers\Verify;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Events\TriggerSms;

class VerifyController extends Controller {

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

  public function postRegsms(Request $request) 
  {
    $mobile = $request->input('mobile'); 

    $user = User::where('mobile', '=', $mobile)

      ->first();

    if (!empty($user->id)) {
    
      return $this->failResponse('该手机号已被注册，请更换手机号！');
    
    } else {
    
      $result = event(new TriggerSms($mobile, 'register')); 

      return $this->successResponse('res', $result);
    
    }
  
  }

}
