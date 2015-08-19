<?php namespace App\Http\Controllers\ReceiverInfos;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ReceiverInfo;
use App\User;
use Auth;
use Validator;

class ReceiverInfosController extends Controller {

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

  public function postAdd (Request $request) 
  {
    $validate = Validator::make($request->input(), [
    
      'receiver' => 'required',

      'city' => 'required',

      'district' => 'required',

      'address' => 'required',
    
      'mobile' => 'required',

      'post_code' => 'required'

    ]);

    if ($validate->fails()) {
    
      $failed = $validate->failed();

      $message = array();

      foreach ($failed as $key => $val) {

        $message[$key] = $this->receiverinfoRequiredFields($key); 
      
      } 

      return $this->failResponse($message);
    
    }

    $input = $request->all();

    $user = Auth::user();

    $input['uid'] = $user->id;

    unset($input['_token']);

    $result = ReceiverInfo::create($input);

    $html = $this->htmlTemplate($result);
  
    return $this->successResponse('result', $html);

  }

  public function receiverinfoRequiredFields ($key)
  {
  
    $fields = array (
    
      'receiver' => '* 请填写收货人！',

      'city' => '* 请选择城市！',

      'district' => '* 请选择区域！',

      'address' => '* 请填写详细地址！',
    
      'mobile' => '* 请填写收货人手机号！',

      'post_code' => '* 请填写邮编！'
    
    );
  
    return $fields[$key];
  
  }

  public function postDelete (Request $request) {
  
    $id = $request->input('id');

    $user = Auth::user();

    $result = ReceiverInfo::where('uid', '=', $user->id)

      ->where('id', '=', $id)

      ->update(['active' => 0]);

    return $this->successResponse('result', $result);
  
  }

  private function htmlTemplate ($obj) {

    $html = "<tr id=\"receiver-item-{$obj->id}\" data-id=\"{$obj->id}\">";

    $html .= "<td class=\"col-md-1 t-center\">";

    $html .= "<label class=\"radio no-margin\">";
  
    $html .= "<input type=\"radio\" name=\"selected-receiver\">";
  
    $html .= "</label>";

    $html .= "</td>";

    $html .= "<td class=\"col-md-1  t-center\">{$obj->receiver}</td>";

    $html .= "<td class=\"col-md-6  t-center\">{$obj->city}&nbsp;{$obj->district}&nbsp;{$obj->address}</td>";

    $html .= "<td class=\"col-md-3  t-center\">{$obj->mobile}</td>";

    $html .= "<td class=\"col-md-1  t-center\">";

    $html .= "<a href=\"#\" class=\"edit-car\" data-target=\"\">";

    $html .= "<span class=\"glyphicon glyphicon-edit\"></span>";

    $html .= "</a>";

    $html .= " | ";

    $html .= "<a href=\"#\" class=\"remove-receiver\" data-id=\"{$obj->id}\" data-type=\"receiver\" data-target=\"receiver-item-{$obj->id}\">";


    $html .= "<span class=\"glyphicon glyphicon-trash\" data-id=\"{$obj->id}\"></span>";

    $html .= "</a>";

    $html .= "</td>";

    $html .= "</tr>";

    return $html;

  }

}
