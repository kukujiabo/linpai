<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cars', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('uid');
      $table->string('owner');
      $table->string('brand')->nullable();
      $table->string('factory_code');
      $table->string('reco_code');
      $table->string('dir_identity_face');
      $table->string('dir_identity_back');
      $table->string('dir_trans_ensurance');
      $table->string('dir_car_check');
      $table->string('dir_validate_paper');
      $table->string('ext_0')->nullable();
      $table->string('car_type')->nullable();
      $table->integer('last_used')->nullable();
      $table->integer('active')->default(1);
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
		Schema::drop('cars');
	}

}
