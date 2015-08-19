<?php namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;

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
    $goods = Good::all();

    $homeGoodsDisplay = array();

    foreach ($goods as $key => $good) {

      if (0 == $key % 2) {

        $homeGoodsDisplay[$key / 2] = array();

      }

      $homeGoodsDisplay[$key / 2][] = $good;

    }

    return view('home', array(
    
      'goods' => $homeGoodsDisplay,

      'home' => 1
    
    ));

	}

}
