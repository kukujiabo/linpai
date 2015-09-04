<?php namespace App\Handlers\Events;

use App\Events\TriggerBounGenerator;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class BounTriggerHandler {

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
	 * @param  TriggerBounGenerator  $event
	 * @return void
	 */
	public function handle(TriggerBounGenerator $event)
	{
		//
    return $event->generate();
	}

}
