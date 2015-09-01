<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class SigningUp extends Event {

	use SerializesModels;

  protected $listen = [
  
    'App\Events\SigningUp' => [ 'App\Handlers\Events\UserSignupTrigger'],
  
  ];

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($user)
	{
      
    
	}

}
