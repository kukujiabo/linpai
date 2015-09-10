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
    $validate = $this->receiverValidate($request->input());

    if ($validate->fails()) {
    
      return $this->failResponse($this->validateFail($validate));
    
    }

    $input = $request->all();

    $user = Auth::user();

    $input['uid'] = $user->id;

    unset($input['_token']);

    $result = ReceiverInfo::create($input);

    $html = $this->htmlTemplate($result);
  
    return $this->successResponse('result', $html);

  }

  public function postEdit (Request $request)
  {
    $validate = $this->receiverValidate($request->input());

    if ($validate->fails()) {
    
      return $this->validateFail($validate);
    
    }

    $rid = $request->input('rid');

    if (empty($rid)) {
    
      return $this->failResponse('no_rid');
    
    }

    $input = $request->input();

    $receiver = ReceiverInfo::find($rid);

    $attributes = $receiver->getAttributes();

    foreach ($input as $key => $value) {
    
      if (array_key_exists($key, $attributes)) {

        $receiver->$key = $value;
      
      }
    
    }

    $res = $receiver->save();

    if ($res) {

      $html = $this->htmlTemplate($receiver);
    
      return $this->successResponse('result', $html);
    
    } else {

      /*
       * todo
       */
    
      return $this->failResponse();
    
    }

  }

  public function receiverinfoRequiredFields ($key)
  {
  
    $fields = array (
    
      'receiver' => '* 请填写收货人！',

      'province' => '* 请选择省份！',

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

  public function getReceiverinfo (Request $request) {
  
    $rid = $request->input('oid');

    $receiver = ReceiverInfo::where('id', '=', $rid)

      ->where('active', '=', 1)

      ->first();
  
    if (empty($receiver->id)) {

      return $this->failResponse();

    } else {
    
      return $this->successResponse('receiver', $receiver);
    
    }
  
  }

  private function htmlTemplate ($obj) {

    $iurl = url('receiver/receiverinfo');

    $html = "<tr id=\"receiver-item-{$obj->id}\" data-id=\"{$obj->id}\">";

    $html .= "<td class=\"col-md-2 t-center\" style=\"padding-left:10px;\">";

    $html .= "<label class=\"radio no-margin\">";

    $html .= "<div class=\"use-card t-padding\" id=\"use-receiver-{$obj->id}\" data-id=\"{$obj->id}\">";

    $html .= "{$obj->receiver}&nbsp;&nbsp;&nbsp;&nbsp;{$obj->city}";

    $html .= "<input class=\"hide\" type=\"radio\" name=\"selected-receiver\" data-id=\"{$obj->id}\">";

    $html .= "</div>";
  
    $html .= "</label>";

    $html .= "</td>";

    $html .= "<td class=\"col-md-2  t-center\">";
    
    $html .= "<div class=\"t-padding\">{$obj->receiver}</div>";
    
    $html .= "</td>";

    $html .= "<td class=\"col-md-4  t-center\">";
    
    $html .= "<div class=\"t-padding over-elis receive-address \">{$obj->province}&nbsp;{$obj->city}&nbsp;{$obj->district}&nbsp;{$obj->address}</div>";
          
    $html .= "</td>";

    $html .= "<td class=\"col-md-1  t-center\">";
    
    $html .= "<div class=\"t-padding\">{$obj->mobile}</div>";
    
    $html .= "</td>";

    $html .= "<td class=\"col-md-2  t-center\">";

    $html .= "<div class=\"t-padding edit-col\">";

    $html .= "<a href=\"#\" class=\"itm-edit\" data-id=\"$obj->id\" data-iurl=\"{$iurl}\" data-key=\"receiver\">";

    $html .= "<span class=\"glyphicon glyphicon-edit edit-col\"></span>";

    $html .= "</a>";

    $html .= "&nbsp;&nbsp; | &nbsp;&nbsp;";

    $html .= "<a href=\"#\" class=\"remove-receiver\" data-id=\"{$obj->id}\" data-type=\"receiver\" data-target=\"receiver-item-{$obj->id}\">";


    $html .= "<span class=\"glyphicon glyphicon-trash edit-col\" data-id=\"{$obj->id}\"></span>";

    $html .= "</a>";

    $html .= "</div>";

    $html .= "</td>";

    $html .= "</tr>";

    return $html;

  }

  private function receiverValidate($input)
  {
    return Validator::make($input, [
    
      'receiver' => 'required',

      'province' => 'required',

      'city' => 'required',

      'district' => 'required',

      'address' => 'required',
    
      'mobile' => 'required',

      'post_code' => 'required'
    
    ]);      
  
  }

  private function validateFail($validate)
  {
    $failed = $validate->failed();

    $message = array();

    foreach ($failed as $key => $val) {

      $message[$key] = $this->receiverinfoRequiredFields($key); 
    
    } 

    return $message;
  
  }

}
