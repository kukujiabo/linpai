<?php namespace app\http\controllers\order;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\Order;
use App\Models\GoodAttribsInfo;
use Illuminate\Http\Request;


class OrdersController extends Controller {

  /*
   *
   */
  public function __construct ()
  {
  
    $this->middleware('auth');
  
  }

  /*
   * @return Response
   */
  public function postIndex(Request $request) 
  {

    $gid = $request->input('gid');

    $num = $request->input('gnum');

    if (empty($gid)) {

      //todo return redirect

    }

    if (!is_numeric($num) || $num < 1) {

      //TODO return redirect

    }

    $good = Good::where('id', '=', $gid)->first();

    if ($good == null) {

      //todo return

    }

    $goodAttribsInfo = $this->getGoodAttributesInfo($gid);

    $data = [

      'good' => $good,

      'num' => $num,

      'good_attribs' => $goodAttribsInfo

    ];


    return view('orders/orderInfo', $data); 
  }

  /*
   *
   *
   * @return Response
   */
  public function getPay() 
  {

    return view('orders/pay');
  
  }


  /*
   *
   *
   *
   */
  public function getPaysuccess()
  {
  
    return view('orders/pay_success');
  
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

  /*
   * 
   *
   * @return string
   */
  private function orderCode($uid, $gid) 
  {
  
    $time = time();

    $code = md5($uid . $gid . $time);

    return $code;
  
  }

  private function getGoodAttributesInfo ($gid) 
  {

    $goodAttributes = GoodAttribsInfo::where('gid', '=', $gid)->get();

    return $goodAttributes; 

  }

}
