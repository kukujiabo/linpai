<?php namespace App\Http\Middleware;

use Closure;
use App\Models\GoodAttribsInfo;

class UploadValidateMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
    $code = $request->input('code');

    if (empty($code)) {

      return json_encode(array (
      
        'code' => 0,

        'msg' => 'upload required code.' 
      
      )); 

    }

    $spec = $request->input('spec');

    if (empty($spec)) {
    
      return json_encode(array (
      
        'code' => 0,

        'msg' => 'upload required spec.' 
      
      )); 
    
    }

    $gaInfos = GoodAttribsInfo::where('acode', '=', $code)

      ->where('spec', '=', $spec)
      
      ->findOne();

    if (empty($gaInfos)) {
    
      return json_encode(array (
        
          'code' => 0,

          'msg' => 'Invalide code or spec.'
        
      ));
    
    }

    $request['gaInfos'] = $gaInfos;

		return $next($request);
	}

}
