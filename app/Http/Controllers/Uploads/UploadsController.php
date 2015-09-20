<?php namespace App\Http\Controllers\Uploads;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UploadsController extends Controller {

  public function __construct () 
  {

    $this->middleware('auth');
  
    $this->middleware('upload');

  }

  /*
   *
   *
   */
  public function postIndex(Request $request) 
  {

    return  $this->handleUpload($request);

  }

  public function postWebImage(Request $request)
  {
  
    
  
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

  protected function handleUpload ($request)
  {
    $code = $request->input('code');

    $spec = $request->input('spec');

    $path = storage_path() . '/app/uploads/tmps/';

    $user = Auth::user();

    $userDir = md5($user->id . $user->mobile); 

    $storage_path = $path . $userDir;

    if ($request->hasFile($code)) {

      $file = $request->file($code);

      if ($file->getSize() > 3145728) {

        return $this->failResponse('size_exceed');

      }

      if (!is_dir($storage_path)) {
      
        try {

          mkdir($storage_path, 0777, true);

        } catch (Exception $e) {
        
          return $this->failResponse('upload storage failed.');
        
        }
      
      } 

      $filename = md5($file->getClientOriginalName());

      $file->move($storage_path, $filename); 

      $preview = '/imgs/tmps/' . $userDir . '/' . $filename;

      $tmpFile = $userDir . '/' . $filename;

      $res = array (
      
        'preview' => $preview,

        'tmpfile' => $tmpFile
      
      );

      return $this->successResponse('res', $res);

    } else {

      return $this->failResponse('empty_file');

    }
    
  }

}
