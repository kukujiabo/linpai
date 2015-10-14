<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertises', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('code');
      $table->string('type');
      $table->string('url');
      $table->integer('seq');
      $table->integer('active');
      $table->string('link')->nullable();
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
		Schema::drop('advertises');
	}

}
