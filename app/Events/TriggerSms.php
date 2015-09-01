<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;


class TriggerSms extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($mobile, $type)
	{
    switch ($mobile) {

      case 'register': 

        $this->registerSms($mobile);

        break;
    
    
    
    }
     
	}

  private function registerSms ($mobile) 
  {
  
  
  
  }


}
