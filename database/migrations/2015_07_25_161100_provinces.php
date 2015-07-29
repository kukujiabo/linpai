<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Provinces extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('provinces', function (Blueprint $table) {

      $table->increments('id');
      $table->string('cname');
      $table->string('ename');
      $table->string('code');
      $table->integer('country_id');
      $table->string('ext_0')->nullable();
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
    Schema::drop('provinces');
	}

}
