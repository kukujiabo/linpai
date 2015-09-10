<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResetPasswordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reset_passwords', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('mobile');
      $table->string('token');
      $table->integer('active')->default(1);
      $table->integer('status')->default(0);
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
		Schema::drop('reset_passwords');
	}

}
