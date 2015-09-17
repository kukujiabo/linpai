<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserManageController extends Controller {


  public function __construct()
  {
    $this->middleware('admin_auth'); 
  }


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
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

  public function getIndex(Request $request) 
  {
    $user_name = $request->input('user_name');

    $mobile = $request->input('mobile');

    $mail = $request->input('mail');

    $page = $request->input('page');

    $offset = 20;

    $pages = ceil(User::count()/20);

    $page = !empty($page) ? $page > $pages ? $pages : $page < 1 ? 1 : $page : 1;

    $query = User::where('id', '>', 0);

    if (!empty($mobile)) {

      $query->where('mobile', '=', $mobile);

    }

    if (!empty($user_name)) {

      $query->where('name', '=', $user_name);

    }

    if (!empty($mail)) {

      $query->where('email', '=', $mail);

    }
      
    $users = $query->skip(($page - 1) * $offset)

              ->take($offset)

              ->get();

    $data = [
    
      'users' => $users,

      'current_page' => $page,

      'pages' => $pages,

      'pageName' => '用户管理',

      'user_name' => empty($user_name) ? '' : $user_name,

      'mobile' => empty($mobile) ? '' : $mobile,

      'mail' => empty($mail) ? '' : $mail
    
    ];

    return view('/admin/user_board', $data);

  }

}