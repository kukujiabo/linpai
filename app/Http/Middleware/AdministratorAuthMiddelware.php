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

      return redirect('/administrator_$2y$10$m1lWH3HqB9oimrxrB3Ea7uu76y5xxUqsldjEpuiWu7H5r6uCGdNSS/login');

    }

		return $next($request);

	}

}
