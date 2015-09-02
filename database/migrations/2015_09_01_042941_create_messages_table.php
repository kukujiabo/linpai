<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('mobile');
      $table->integer('uid')->nullable();
      $table->text('content')->nullable();
      $table->integer('success')->nullable();
      $table->string('status')->nullable();
      $table->string('send_id')->nullable();
      $table->string('sms_credits')->nullable();
      $table->string('code')->nullable();
      $table->string('msg')->nullable();
      $table->datetime('deliver_at')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('messages');
	}

}
