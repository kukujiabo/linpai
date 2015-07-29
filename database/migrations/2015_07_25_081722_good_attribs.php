<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GoodAttribs extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('good_attribs', function (Blueprint $table) {
    
      $table->increments('id');
      $table->integer('gid');
      $table->integer('aid');
      $table->string('value', 500);
      $table->string('comment', 100)->nullable();
      $table->string('ext_0', 200)->nullable();
      $table->string('ext_1', 200)->nullable();
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
    Schema::drop('good_attribs');
	}

}
