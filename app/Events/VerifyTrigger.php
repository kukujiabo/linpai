<?php namespace App\Events;

use App\Events\Event;
use App\Models\RegisterVerify;
use Illuminate\Queue\SerializesModels;

class VerifyTrigger extends Event {

	use SerializesModels;

  protected $info;

  protected $type;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($info, $type)
	{
		//
    $this->info = $info;
    
    $this->type = $type;

	}

  private function verifyRegister()
  {
    $mobile = $this->info['mobile'];

    $code = $this->info['code']; 

    $verify = RegisterVerify::where('mobile', '=', $mobile)

      ->where('verify_code', '=', $code)

      ->where('active', '=', 1)

      ->first();

    if (empty($verify->id)) {
    
      return [ 'code' => 0, 'type' => 'not_found' ];
    
    }

    $now = strtotime(date('Y-m-d H:i:s'));
  
    $sentTime = strtotime($verify->deliver_at);
  
    $duration = ceil(($now - $sentTime)/60);

    /*
     * 过期
     */
    if ($duration > 30) {
    
      $verify->success = 0;

      $verify->active = 0;

      $verify->save();

      return [ 'code' => 0, 'type' => 'delay' ]; 
    
    } else {

      $verify->success = 1;

      $verify->active = 0;

      $verify->save();
    
      return ['code' => 1];
    
    }
  
  }

  public function verify () 
  {
    switch ($this->type) {
    
      case 'register': 

        return $this->verifyRegister();

        break;
    
    } 
  
  }

}
