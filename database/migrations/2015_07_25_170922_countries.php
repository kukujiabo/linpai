<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Countries extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('countries', function (Blueprint $table) {

      $table->increments('id');
      $table->string('cname');
      $table->string('ename');
      $table->string('type')->nullable();
      $table->string('code');
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
    Schema::drop('countries');
	}

}
