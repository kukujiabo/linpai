<?php namespace App\Handlers\Events;

use App\Events\TriggerSms;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class TriggerSmsSend {

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
	 * @param  TriggerSms  $event
	 * @return void
	 */
	public function handle(TriggerSms $event)
	{
		//
	}

}
