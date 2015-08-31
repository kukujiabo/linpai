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
	public function __construct($user)
	{
		//
require_once app_path() . '/libraries/submailsms/app_config.php';
require_once app_path() . '/libraries/submailsms/SUBMAILAutoload.php';
var_dump($message_configs);
    $submail = new MESSAGEXsend($message_configs);

    $submail->AddTo("15201932985");

    $submail->SetProject("kasd");

    $submail->xsend();
     
	}


}
