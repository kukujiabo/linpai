<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Districts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('districts', function (Blueprint $table) {
    
      $table->increments('id');
      $table->string('cname');
      $table->string('ename');
      $table->string('code'); 
      $table->string('ext_0')->nullable();
      $table->integer('city_id'); 
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
    Schema::drop('districts');
	}

}
