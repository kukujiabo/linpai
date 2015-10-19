<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\ImageCata;
use Illuminate\Http\Request;
use App\Models\Advertise;

class AdvertiseManageController extends Controller {

  private $route = 'administrator_$2y$10$m1lWH3HqB9oimrxrB3Ea7uu76y5xxUqsldjEpuiWu7H5r6uCGdNSS';

  public function __construct ()
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

    $type = $request->input('type');

    $code = $request->input('code');

    $offset = 20;

    $query = Advertise::where('id', '>', 0);

    if (!empty($type)) {

      $query->where('type', '=', $type);

    }

    if (!empty($code)) {

      $query->where('code', '=', $code);

    }

    $count = $query->count();

    $pages = ceil($count/$offset);

    $page = !empty($page) ? $page > $pages ? $pages : $page < 1 ? 1 : $page : 1;

    $ads = $query->skip(($page - 1) * $offset)

      ->take($offset)

      ->get();

    $data = [

      'pageName' => '广告位管理',

      'current_page' => $page,

      'pages' => $pages,

      'ads' => $ads,

      'route' => $this->route

    ];

    return view('admin/advertise_board', $data);

  }

  public function postImgupload (Request $request)
  {
    $code = $request->input('code');  

    $type = $request->input('type');

    if (empty($code)) {

      return $this->failResponse('empty_code');

    }

    if (empty($type)) {

      return $this->failResponse('empty_type');

    }

    if (!$request->hasFile($code)) {

      return $this->failResponse('file_empty');

    }

    $imgCata = ImageCata::where('type', '=', $type)->get();

    if (empty($imgCata)) {

      return $this->failResponse('invalid_type');

    }

    $path = $imgCata->store_path;

    /*
     * 如果不存在目录则创建目录
     */
    if (!is_dir($path)) {

      mkdir($path, 0777, true);

    }
    
  }

}
