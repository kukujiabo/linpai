<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Cooperators;
use Illuminate\Http\Request;

class CoopManageController extends Controller {

  private $route = 'administrator_$2y$10$m1lWH3HqB9oimrxrB3Ea7uu76y5xxUqsldjEpuiWu7H5r6uCGdNSS';

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

  public function getIndex (Request $request) 
  {
    $page = $request->input('page'); 

    $offset = 20;

    $pages = ceil(Cooperators::count()/$offset);

    $page = empty($page) ? 1 : $page > $pages ? $pages : $page < 1 ? 1 : $page;

    $excel = $request->input('excel');

    $province = $request->input('province');

    $city = $request->input('city');

    $district = $request->input('district');

    $query  = Cooperators::where('id', '>', 0);
    
    if (!empty($province)) {

      $query->where('province', '=', $province);

    }

    if (!empty($city)) {

      $query->where('city', '=', $city);

    }

    if (!empty($district)) {

      $query->where('district', '=', $district);

    }

    if (empty($excel)) {

      $coopers = $query->skip(($page - 1) * $offset)->take($offset)->orderBy('created_at', 'desc')->get();

      $data = [

        'cooperators' => $coopers,
      
        'pageName' => '合作伙伴',

        'current_page' => $page,

        'pages' => $pages,

        'route' => $this->route
      
      ];

      return view('admin/coope_board', $data);

    } else {

      $coopers = $query->get();

      require_once('phpexcel/Classes/PHPExcel.php');

      $excel = new \PHPExcel();

      $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H' ];

      $tableheader = [ '序号', '联系人', '公司', '手机号', '固定电话', '所属区域', '电子邮箱', '提交时间' ];

      for ($i = 0; $i < count($tableheader); $i++) {

        $excel->getActiveSheet()->setCellValue("{$letters[$i]}1", "{$tableheader[$i]}");

      }

      $j = 2;

      foreach ($coopers as $cooper) {

        $excel->getActiveSheet()->setCellValue("A{$j}", $cooper->id);
        $excel->getActiveSheet()->setCellValue("B{$j}", $cooper->contact);
        $excel->getActiveSheet()->setCellValue("C{$j}", $cooper->company);
        $excel->getActiveSheet()->setCellValue("D{$j}", $cooper->mobile);
        $excel->getActiveSheet()->setCellValue("E{$j}", $cooper->phone);
        $excel->getActiveSheet()->setCellValue("F{$j}", $cooper->province . $cooper->city . $cooper->district);
        $excel->getActiveSheet()->setCellValue("G{$j}", $cooper->email);
        $excel->getActiveSheet()->setCellValue("H{$j}", $cooper->created_at . '');

        $j++;

        $doc = new \PHPExcel_Writer_Excel5($excel);

        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="cooperators.xls"');
        header("Content-Transfer-Encoding:binary");

        $doc->save('php://output');

      }

    }

  }

}
