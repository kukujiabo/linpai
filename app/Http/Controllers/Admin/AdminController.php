<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderInfo;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Session;
use Auth;

class AdminController extends Controller {

  public function __construct () 
  {
    $this->middleware('admin_auth', [ 'except' => ['getLogin', 'postLogin'] ]); 
  }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin/admin_home', $data);

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

  public function getLogin (Request $request) 
  {
  
    return view('admin/admin_login');
  
  }

  public function postLogin (Request $request) 
  {
    $validate = Validator::make($request->input(), [
    
      'admin_name' => 'required',

      'password' => 'required'
    
    ]);

    if ($validate->fails()) {

      $failed = $validate->failed();

      return $this->failResponse($failed);

    }

    $user = Auth::user();

    if (!empty($user->id)) {

      Auth::logout();

    }

    $admin = Admin::where('admin_name', '=', $request->input('admin_name'))

      ->where('active', '=', 1)

      ->first();

    if (empty($admin->id)) {

      return $this->failResponse('not_found');

    }

    if ($admin->password != md5($request->input('password'))) {

      return $this->failResponse('not_match');

    }

    Session::put([ 'admin' => $admin ]);

    $admin->last_login_time = date('Y-m-d H:i:s');

    $admin->last_login_ip = $_SERVER['REMOTE_ADDR'];

    $admin->save();

    return $this->successResponse();

  }

  public function getIndex (Request $request) 
  {
    $pageName = "首页";

    $users = User::all();

    $orders = Order::all();

    $data = [
    
      'users' => $users,

      'orders' => $orders,

      'pageName' => $pageName
    
    ];

    return view('admin/admin_home', $data);

  } 


  public function getUser (Request $request)
  {
  
    $pageName = "用户管理";

    return view('admin/user_board', [
    
      'pageName' => $pageName
    
    ]);
  
  }

  public function getOrder (Request $request) 
  {

    $query = array();

    //获得查询订单编码
    $orderCode = $request->input('order_code');

    //获得用户id
    $uid = $request->input('uid');

    //获得商品id
    $gid = $request->input('gid');

    //获得订单状态
    $type = $request->input('type');

    //获得起始时间
    $startDate = $request->input('start_date');

    //获得结束时间
    $endDate = $request->input('end_date');

    $pageName = "订单管理";
    
    $orderInfos = OrderInfo::query();

    return view('admin/order_board', [
    
      'pageName' => $pageName
    
    ]); 
  
  }

  public function postLogout (Request $request) 
  {

    Session::forget('admin');
          
    return redirect('/home');

  }

  public function searchBox (Request $request)
  {
    
  
  
  }

}
