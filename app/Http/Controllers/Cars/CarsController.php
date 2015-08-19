<?php namespace App\Http\Controllers\Cars;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Validator;
use Auth;

class CarsController extends Controller {

  public function postAdd(Request $request)
  {
    $form = $request->input();
      
    $validate = Validator::make($request->input(), [
    
      'owner' => 'required|min:2',

      'brand' => 'required',

      'factory_code' => 'required',

      'reco_code' =>'required',

      'dir_identity_face' => 'required',

      'dir_identity_back' => 'required',

      'dir_trans_ensurance' => 'required',

      'dir_car_check' => 'required',

      'dir_validate_paper' => 'required'
    
    ]);

    if ($validate->fails()) {
    
      $failed = $validate->failed();

      $message = array();

      foreach ($failed as $key => $fail) {
      
        $message[$key] = $this->carinfoRequiredField($key);
      
      }

      $imgBase = storage_path() . '/app';

      return $this->failResponse($message);
    
    }

    $user = Auth::user();

    $input = $request->all();

    $input['uid'] = $user->id;

    unset($input['_token']);
    
    $result = Car::create($input);

    $html = $this->htmlTemplate($result);

    return $this->successResponse('result', $html);
  
  }

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

  public function postDelete (Request $request) {

    $id = $request->input('id');

    $user = Auth::user();

    $result = Car::where('uid', '=', $user->id)

      ->where('id', '=', $id)
      
      ->update(['active' => 0]);

    return $this->successResponse('result', $result);
  
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

  private function carinfoRequiredField ($key) 
  {
  
    $fields = array();
    
    $fields["owner"] = "车辆所有人 必须填写！";

    $fields["brand"] = "车辆品牌 必须填写！";

    $fields["factory_code"] = "车辆厂牌型号 必须填写！";

    $fields["reco_code"] = "识别号码（车架号）必须填写！";

    $fields["dir_identity_face"] = "身份证正面 上传失败，请重新上传！";

    $fields["dir_identity_back"] = "身份证背面 上传失败，请重新上传！";

    $fields["dir_trans_ensurance"] = "交强险副本扫描件 上传失败，请重新上传！";

    $fields["dir_car_check"] = "车辆购买发票 上传失败，请重新上传！";

    $fields["dir_validate_paper"] = "合格证件 上传失败，请重新上传！";
  
    return $fields[$key];
  
  }

  private function htmlTemplate ($obj) 
  {
    $html = "<tr id=\"car-item-{$obj->id}\" data-id=\"{$obj->id}\">"; 

    $html .= "<td class=\"col-md-1 text-center\" style=\"padding-left:40px;\">";

    $html .= "<label class=\"radio no-margin\">";

    $html .= "<input type=\"radio\" name=\"selected-car\">";

    $html .= "<td class=\"col-md-2 text-center\">";

    $html .= $obj->owner;

    $html .= "</td>";

    $html .= "<td class=\"col-md-4 text-center\">";

    $html .= $obj->brand;

    $html .= "</td>";

    $html .= "<td class=\"col-md-4 text-center\">";

    $html .= $obj->reco_code;

    $html .= "</td>";

    $html .= "<td class=\"col-md-1 text-center\">"; 

    $html .= "<a href=\"#\" class=\"edit-car\">";

    $html .= "<span class=\"glyphicon glyphicon-edit\"></span>";

    $html .= "</a>";

    $html .= " | ";

    $html .= "<a href=\"#\" class=\"remove-car\" data-type=\"car\" data-target=\"car-item-{$obj->id}\" data-id=\"{$obj->id}\">";

    $html .= "<span class=\"glyphicon glyphicon-trash\"></span>";

    $html .= "</a>";

    $html .= "</td>";

    $html .= "</tr>";

    return $html;

  }

}
