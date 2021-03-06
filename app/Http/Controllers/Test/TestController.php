<?php namespace App\Http\Controllers\Test;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Events\TriggerSms;
use App\Events\TriggerEmail;
use Illuminate\Http\Request;


class TestController extends Controller {

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

  public function getSms() 
  {
    $result = event(new TriggerSms(15201932985, 'register'));  
  
    var_dump($result);
  }

  public function getMail()
  {

    $result = event(new TriggerEmail('kukujiabo@163.com', 'register', [ 'mobile' => '15201932985']));

    var_dump($result);

  }

  public function getInvitemail()
  {
  
    $result = event(new TriggerEmail('kukujiabo@163.com', 'invite', [ 'friend' => 'meroc', 'recommend' => '123456']));

    var_dump($result);
  
  }

  public function getPayed () 
  {
    $mail = event(new TriggerEmail('kukujiabo@163.com', 'payed', [ 
      
      'order_code' => '123',
      
      'recommend' => '123',

      'order_date' => '123'
    
    ]));
  
    var_dump($mail);
  }

  public function getFriend ()
  {
    $mail = event(new TriggerEmail('kukujiabo@163.com', 'friend_use', [ 'friend' => '123']));
  
    var_Dump($mail);
  
  }

  public function getInvitesms ()
  {
    $sms = event(new TriggerSms('15201932985', 'goshare', [
    
      'code' => '123213'
    
    ])); 

    var_dump($sms);
  
  }

}
