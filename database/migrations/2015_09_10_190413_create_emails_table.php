<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emails', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('title')->nullable();
      $table->string('to')->nullable();
      $table->string('from')->nullable();
      $table->string('cc')->nullable();
      $table->string('subject')->nullable();
      $table->string('mail_type')->nullable();
      $table->string('status')->nullable();
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
		Schema::drop('emails');
	}

}
