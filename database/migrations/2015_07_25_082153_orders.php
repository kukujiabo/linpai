<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('orders', function (Blueprint $table) {
      
      $table->increments('id');
      $table->string('code', 100)->unique();
      $table->integer('uid');
      $table->integer('cid');
      $table->integer('gid');
      $table->integer('rid');
      $table->integer('sum');
      $table->integer('num');
      $table->string('comment', 200)->nullable();
      $table->string('plate_number')->nullable();
      $table->integer('status');
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
    Schema::drop('orders');
	}

}
