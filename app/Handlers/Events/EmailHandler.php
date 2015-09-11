<?php namespace App\Handlers\Events;

use App\Events\TriggerEmail;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  TriggerEmail  $event
	 * @return void
	 */
	public function handle(TriggerEmail $event)
	{
		//
    //
    return $event->execSend();
	}

}
