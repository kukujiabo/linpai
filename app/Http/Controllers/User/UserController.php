<?php namespace App\Http\Controllers\User; 
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Events\TriggerSms;
use Validator;
use Session;
use App\Models\ResetPassword;
use Auth;

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

    $data['wTitle'] = '重置密码';

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

      if (!empty($request->input('mb'))) {
      
      
      } else {

        return redirect('/user/password');

      }

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

    $rp->active = 0;

    $rp->status = 1;

    $rp->save();

    $user->password = bcrypt($inputs['newpassword']);
  
    $res = $user->save();

    if ($res) {

      return $this->successResponse();

    } else {

      return $this->failResponse('save_failed');

    }
  
  }

  public function postAjaxresetsms(Request $request)
  {
    $mobile = $request->input('mobile'); 

    if (empty($mobile) || strlen($mobile) < 11) {
    
      return $this->failResponse('invalid_mobile');
    
    }

    $res = event(new TriggerSms($mobile, 'reset_passwd'));
  
    return $this->successResponse('result', $res);
  
  }

  public function postAjaxlogin (Request $request)
  {
    $mobile = $request->input('mobile');

    $password = $request->input('password'); 

    if (empty($mobile) || strlen($mobile) != 11) {
    
      return $this->failResponse('invalid_mobile');
    
    } 

    if (empty($password) || strlen($password) == 0) {
    
      return $this->failResponse('invalid_password');
    
    }

    $user = User::where('mobile', '=', $mobile)->first();

    if (empty($user->id)) {
    
      return $this->failResponse('user_not_found');
    
    }

    if (Auth::attempt(['mobile' => $mobile, 'password' => $password])) {

      return $this->successResponse();

    } else {

      return $this->failResponse('attemp_fail');

    }

  }

}
