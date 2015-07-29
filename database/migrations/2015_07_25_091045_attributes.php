<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Attributes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('attributes', function (Blueprint $table) {

      $table->increments('id');
      $table->string('name');
      $table->string('code')->unique();
      $table->string('spec')->nullable();
      $table->string('intro');
      $table->integer('parent');
      $table->integer('class');
      $table->integer('important');
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
    Schema::drop('attributes');
	}

}
