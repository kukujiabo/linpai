<?php namespace App\Http\Controllers\MiniSite;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Good;
use App\Models\OrderAllInfo;
use App\Models\ReceiverInfo as Receiver;
use App\Models\Boun;
use App\Models\Car;
use Auth;

class OrderController extends Controller {

  public function __construct() 
  {

    $this->middleware('mobile_auth');

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

  public function getCartype()
  {
  
    return view('mobile/cartype');
  
  }

  public function getBuy(Request $request)
  {
    $gcode = $request->input('gcode');

    $ch = $request->input('car_hand');

    if (empty($ch) || strlen($ch) == 0) {
    
      return redirect('/miniorder/cartype');

    }

    $user = Auth::user();
    
    $gcode = (empty($gcode) || strlen($gcode) == 0) ? 'beyond-three' : $gcode;

    $good = Good::where('code', '=', $gcode)->first();

    if (empty($good)) {
      
      //todo
    
    }

    $carhand = $ch == 1 ? 'one' : 'second';

    $cars = Car::where('uid', '=', $user->id)->where('car_hand', '=', $carhand)->orderBy('last_used', 'desc')->get();

    $defaultCar = Car::where('uid', '=', $user->id)->where('car_hand', '=', $carhand)->where('last_used', '=', 1)->first();

    $receivers = Receiver::where('uid', '=', $user->id)->orderBy('last_used', 'desc')->get();
        
    $defaultReceiver = Receiver::where('uid', '=', $user->id)->where('last_used', '=', 1)->first();

    $bouns = Boun::where('uid', '=', $user->id)

        ->where('type', '=', 1)
      
        ->where('active', '=', 1)

        ->get();

    $data = [
      
      'good' => $good,

      'receivers' => $receivers,

      'defaultReceiver' => $defaultReceiver,

      'cars' => $cars,

      'defaultCar' => $defaultCar,

      'bouns' => $bouns
      
    ];

    return view('mobile/buy', $data);
  
  }

}