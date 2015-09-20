<?php namespace App\Http\Controllers\Cars;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Validator;
use Auth;

class CarsController extends Controller {

  public function __construct () 
  {
    $this->middleware('auth'); 
  }

  public function postAdd(Request $request)
  {
    $form = $request->input();
      
    $validate = $this->carInfoValidate($request->input());

    if ($validate->fails()) {
    
      return $this->validateFail($validate);
    
    }

    $user = Auth::user();

    Car::where('uid', '=', $user->id) ->update([ 'last_used' => 0 ]);

    $input = $request->all();

    $input['uid'] = $user->id;

    $input['last_used'] = 1;

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

  public function postEdit (Request $request)
  {
    $validate = $this->carInfoValidate($request->input());
  
    if ($validate->fails()) {

      return $this->validateFail($validate);

    }

    $cid = $request->input('cid');

    if (empty($cid)) {
    
      return $this->failResponse('no_cid');
    
    }

    $input = $request->input();

    $car = Car::find($cid);

    $attributes = $car->getAttributes();

    foreach ($input as $key => $value) {

      if (array_key_exists($key, $attributes)) {
      
        $car->$key = $value;
      
      }

    }

    $res = $car->save();

    if ($res) {
    
      $html = $this->htmlTemplate($car);

      return $this->successResponse('result', $html);
    
    } else {
    
      return $this->failResponse();
    
    }


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

  public function getCarinfo (Request $request)
  {
    $cid = $request->input('oid');  

    $car = Car::where('id', '=', $cid)

      ->where('active', '=', 1)

      ->first();

    if (empty($car->id)) {
    
      return $this->failResponse();
    
    } else {
    
      return $this->successResponse('car', $car);
    
    }
  
  }

  private function carinfoRequiredField ($key) 
  {
    $fields = array();
    
    $fields["owner"] = "车辆所有人 必须填写！";

    //$fields["brand"] = "车辆品牌 必须填写！";

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
    $infoUrl = url('car/carinfo');

    $html = "<tr id=\"car-item-{$obj->id}\" data-id=\"{$obj->id}\">"; 

    $html .= "<td class=\"col-md-2 text-center\" style=\"padding-left:10px;\">";

    $html .= "<label class=\"radio no-margin\">";

    $html .= "<div class=\"use-card t-padding use-active\" data-id=\"{$obj->id}\" id=\"use-car-{$obj->id}\">{$obj->owner}&nbsp;&nbsp;&nbsp;&nbsp;{$obj->brand}</div>";

    $html .= "<input class=\"hide\" type=\"radio\" name=\"selected-car\" data-id=\"$obj->id\">";

    $html .= "<td class=\"col-md-2 text-center\">";

    $html .= "<div class=\"t-padding\">" . $obj->owner . "</div>";

    $html .= "</td>";

    $html .= "<td class=\"col-md-3 text-center\">";

    $html .= "<div class=\"t-padding\">" . $obj->brand . "</div>";

    $html .= "</td>";

    $html .= "<td class=\"col-md-2 text-center\">";

    $html .= "<div class=\"t-padding\">" . $obj->reco_code . "<div>";

    $html .= "</td>";

    $html .= "<td class=\"col-md-1 text-center edit-col\">"; 

    $html .= "<div class=\"t-padding\">";

    $html .= "<a href=\"#\" class=\"itm-edit\" data-id=\"{$obj->id}\" data-iurl=\"{$infoUrl}\" data-key=\"car\">";

    $html .= "<span class=\"glyphicon glyphicon-edit edit-col\"></span>";

    $html .= "</a>";

    $html .= "&nbsp;&nbsp; | &nbsp;&nbsp;";

    $html .= "<a href=\"#\" class=\"remove-car\" data-type=\"car\" data-target=\"car-item-{$obj->id}\" data-id=\"{$obj->id}\">";

    $html .= "<span class=\"glyphicon glyphicon-trash edit-col\"></span>";

    $html .= "</a>";

    $html .= "</div>";

    $html .= "</td>";

    $html .= "</tr>";

    return $html;

  }

  private function carInfoValidate($values)
  {
    return Validator::make($values, [

      'owner' => 'required|min:2',

      //'brand' => 'required',

      'factory_code' => 'required',

      'reco_code' =>'required',

      'dir_identity_face' => 'required',

      'dir_identity_back' => 'required',

      'dir_trans_ensurance' => 'required',

      'dir_car_check' => 'required',

      'dir_validate_paper' => 'required'
    
    ]);
  
  }

  private function validateFail ($validate)
  {
    $failed = $validate->failed();

    $message = array();

    foreach ($failed as $key => $fail) {
    
      $message[$key] = $this->carinfoRequiredField($key);
    
    }

    return $this->failResponse($message);
  
  }

}
