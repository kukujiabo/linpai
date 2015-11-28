<?php namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Contracts\Auth\Guard;

class MobileAuthMiddleware {

  protected $auth;


  public function __construct(Guard $auth) 
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
    if ($request->path() == 'miniorder/cartype' && $request->input('code') != null) {

      return $next($request);
    
    }

    if ($this->auth->guest()) {

      Session::put('pre_url', '/' . $request->path());
      
      return redirect()->guest('mobile/login');

    }

		return $next($request);

	}

}
