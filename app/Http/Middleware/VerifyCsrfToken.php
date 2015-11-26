<?php namespace App\Http\Middleware;

use Closure;
use Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
    //edit by meroc chen 2015-10-14
    //
    if ($request->is('/order/paynotify') || $request->path() == 'order/wxpay' || $request->path() == 'order/payed') {

      return $next($request);

    }
     
    //original
		return parent::handle($request, $next);

	}

}
