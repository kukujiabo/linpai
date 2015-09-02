<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterVerifiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('register_verifies', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('mobile');
      $table->string('verify_code');
      $table->integer('success');
      $table->integer('active');
      $table->datetime('deliver_at');
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
		Schema::drop('register_verifies');
	}

}
