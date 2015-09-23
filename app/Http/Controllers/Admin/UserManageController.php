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

    $pages = ceil(User::count()/$offset);

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

    $excel = $request->input('excel');

    if (empty($excel)) {
      
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

    } else {

      $users = $query->get();

      require_once('phpexcel/Classes/PHPExcel.php');

      $excel = new \PHPExcel();

      $letters = ['A', 'B', 'C', 'D', 'E', 'F'];

      $tableheader = ['序号', '用户名', '手机号', '邮箱', '注册时间'];

      for ($i = 0; $i < count($tableheader); $i++) {

        $excel->getActiveSheet()->setCellValue("{$letters[$i]}1", "{$tableheader[$i]}");

      }

      $j = 2;

      foreach ($users as $key => $user) {

        $seq = $user->id;

        $name = $user->name; 

        $mobile = $user->mobile;

        $email = $user->email;

        $created_at = $user->created_at;

        $excel->getActiveSheet()->setCellValue("A" . $j, $seq);

        $excel->getActiveSheet()->setCellValue("B" . $j, $name);

        $excel->getActiveSheet()->setCellValue("C" . $j, $mobile);

        $excel->getActiveSheet()->setCellValue("D" . $j, $email);

        $excel->getActiveSheet()->setCellValue("E" . $j, $created_at . '');

        $j++;

      }

      $doc = new \PHPExcel_Writer_Excel5($excel);

      header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
      header("Content-Type:application/force-download");
      header("Content-Type:application/vnd.ms-execl");
      header("Content-Type:application/octet-stream");
      header("Content-Type:application/download");;
      header('Content-Disposition:attachment;filename="users.xls"');
      header("Content-Transfer-Encoding:binary");

      $doc->save('php://output');

    }

  }

  public function getDownloaduserlist(Request $request) 
  {



  }

}
