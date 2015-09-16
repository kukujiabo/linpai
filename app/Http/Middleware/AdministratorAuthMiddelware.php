<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Contracts\Auth\Guard;

class AdministratorAuthMiddelware {

  protected $auth;

  public function __construct (Guard $auth) 
  {

    $this->auth = $auth;

  }

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

    $admin = Session::get('admin');

    if (empty($admin->id) || !$this->auth->guest()) {

      return redirect('/admin/login');

    }

		return $next($request);

	}

}
