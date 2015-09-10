<?php namespace App\Http\Controllers\User; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Events\TriggerSms;
use Validator;
use Session;
use App\Models\ResetPassword;

class UserController extends Controller {


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

  public function getPassword (Request $request)
  {
    $token = md5(time());

    $data = ['form_token' => $token];

    if (Session::get('VERIFYNOUSER')) {

      $data['nouser'] = true;

      Session::forget('VERIFYNOUSER');

    }

    return view('auth/password', $data);

  }

  public function getExists (Request $request) 
  {
    $type = $request->input('type');

    switch ($type) {
    
      case 'mobile':
    
        $count = User::where('mobile', '=', $request->input('value'))

          ->count();

        if ($count > 0) {
        
          return $this->successResponse();
        
        } else {
        
          return $this->failResponse();

        }

        break;

      default:

        break;
    
    }

  }

  public function postResetverify (Request $request) 
  {
    $mobile = $request->input('mobile');

    if (Session::get('reset_form') == $request->input('reset_form_token')) {

      return view('auth/resetverify', [ 'mobile' => $mobile ]);

    } else {

      Session::put('reset_form', $request->input('reset_form_token'));

    }

    $user = User::where('mobile', '=', $mobile)

      ->first();

    if (empty($user->id)) {
    
      return redirect('/user/password')->with('VERIFYNOUSER', true);
    
    }

    $res = event(new TriggerSms($mobile, 'reset_passwd'));
    
    $data = [ 'mobile' => $mobile ];

    return view('auth/resetverify', $data);

  }

  public function postPasswdreset(Request $request) 
  {
    $user = User::where('mobile', '=', $request->input('mobile'))->first();

    if (empty($user->id)) {

      return redirect('/user/password');

    }


    $validate = Validator::make($request->input(), [
    
      'reset_code' => 'required',

      'newpassword' => 'required|min:6|max:18',

      'confirmpassword' => 'required|min:6|max:18',
    
    ]); 

    if ($validate->fails()) {

      $failed = $validate->failed();

      return $this->failResponse($failed);

    }

    $inputs = $request->input();

    $rp = ResetPassword::where('token', '=', $inputs['reset_code'])

      ->where('active', '=', 1)

      ->first();

    if (empty($rp->id)) {

      return $this->failResponse([ 'reset_code' => 'not_found' ]);

    }

    if ($inputs['newpassword'] != $inputs['confirmpassword']) {

      return $this->failResponse('not_match');

    }

    $user->password = bcrypt($inputs['newpassword']);
  
    $res = $user->save();

    if ($res) {

      return $this->successResponse();

    } else {

      return $this->failResponse('save_failed');

    }
  
  }

}
