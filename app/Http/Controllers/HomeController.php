<?php namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Advertise;
use Illuminate\Http\Request;
use App\Models\GoodAttribsInfo;
use App\Models\MassInfo;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
    $goodDatas = Good::orderBy('id', 'desc')->get();

    $goods = array();

    $banners = Advertise::where('type', '=', 'index_banner')
      
      ->where('active', '=', 1)
      
      ->orderBy('seq', 'asc')
      
      ->get();

    foreach ($goodDatas as $good) {

      $gInfo = GoodAttribsInfo::where('gid', '=', $good->id)

        ->where('acode', '=', 'price')

        ->first();

      $good->price = $gInfo->value;

      array_push($goods, $good);

    }

    $homeGoodsDisplay = array();

    foreach ($goods as $key => $good) {

      if (0 == $key % 2) {

        $homeGoodsDisplay[$key / 2] = array();

      }

      $homeGoodsDisplay[$key / 2][] = $good;

    }

    //var_dump($request->cookie('51_linpai'));

    return view('home', array(
    
      'goods' => $homeGoodsDisplay,

      'banners' => $banners,

      'home' => 1
    
    ));

	}

}
