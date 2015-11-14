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
    if ($this->auth->guest()) {
    
      return redirect()->guest('mobile/login');
    
    }

		return $next($request);
	}

}
