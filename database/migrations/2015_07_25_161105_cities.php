<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('cities', function (Blueprint $table) {

      $table->increments('id');
      $table->string('cname');
      $table->string('ename');
      $table->string('code');
      $table->string('ext_0')->nullable();
      $table->integer('country_id');
      $table->integer('province_id');
      $table->integer('post_code')->nullable();
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
		//
    Schema::drop('cities');
	}

}
