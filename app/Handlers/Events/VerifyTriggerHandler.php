<?php namespace App\Handlers\Events;

use App\Events\VerifyTrigger;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class VerifyTriggerHandler {

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
	 * @param  VerifyTrigger  $event
	 * @return void
	 */
	public function handle(VerifyTrigger $event)
	{
		//
    return $event->verify();
	}

}
