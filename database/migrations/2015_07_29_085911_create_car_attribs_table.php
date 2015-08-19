<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarAttribsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_attribs', function(Blueprint $table)
		{

			$table->increments('id');
      $table->integer('cid');
      $table->string('aid');
      $table->string('value', 500)->nullable();
      $table->string('comment', 200)->nullable();
      $table->string('ext_0', 200)->nullable();
      $table->string('ext-1', 200)->nullable();
      $table->integer('active');
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
		Schema::drop('car_attribs');
	}

}
