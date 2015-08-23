<?php namespace App\Http\Controllers\Location;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class LocationController extends Controller {

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

  public function getProvince (Request $request)
  {
    $provinces = Province::all(); 
  
    $html = $this->provinceList($provinces);

    return $this->successResponse('res', $html);
  
  }

  public function getCity (Request $request) 
  {
    $province = $request->input('province');

    $cities = City::where('province_code', '=', $province)

      ->where('active', '=', 1)

      ->get();

    $html = $this->cityList($cities);

    return $this->successResponse('res', $html);
  
  }

  public function getDistrict (Request $request) 
  {
    $city = $request->input('city'); 
  
    $districts = District::where('city_code', '=', $city)

      ->where('active', '=', 1)

      ->get();

    $html = $this->districtList($districts);

    return $this->successResponse('res', $html);
  
  }

  private function cityList ($cities) 
  {
    $html = '';

    foreach ($cities as $city) {
    
      $html .= "<li>";

      $html .= "<a href=\"#\" class=\"city-item\" data-code=\"{$city->code}\">{$city->cname}</a>";
    
      $html .= "</li>";
    
    }

    return $html;
  
  }

  private function districtList ($districts) 
  {
    $html = '';

    foreach ($districts as $district) {
    
      $html .= "<li>";

      $html .= "<a href=\"#\" class=\"district-item\" data-code=\"{$district->code}\">{$district->cname}</a>";
    
      $html .= "</li>";
    
    }

    return $html;
  
  }

  private function provinceList ($provinces)
  {
    $html = ''; 

    foreach ($provinces as $province) {

      $html .= "<li class=\"col-xs-3\">";
    
      $html .= "<a href=\"#\" class=\"province-item\" data-code=\"{$province->code}\">{$province->cname}</a>";

      $html .= "</li>";
    
    }
  
    return $html;

  }

}
