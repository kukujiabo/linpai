<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bouns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('bouns', function (Blueprint $table) {
    
      $table->increments('id');
      $table->integer('note');
      $table->integer('type');
      $table->integer('uid');
      $table->integer('oid')->nullable();
      $table->string('code', 100);
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
    Schema::drop('bouns');

	}

}
