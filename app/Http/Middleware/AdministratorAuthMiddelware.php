<?php namespace App\Http\Middleware;

use Closure;
use Session;

class AdministratorAuthMiddelware {

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

    if (empty($admin->id)) {

      return redirect('/admin/login');

    }

		return $next($request);

	}

}
