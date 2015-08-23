<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cooperators', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('contact');
      $table->string('company')->nullable();
      $table->string('mobile');
      $table->string('telephone')->nullable();
      $table->string('province');
      $table->string('city');
      $table->string('district');
      $table->string('email');
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
		Schema::drop('cooperators');
	}

}
