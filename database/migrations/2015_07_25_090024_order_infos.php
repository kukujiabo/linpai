<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderInfos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('order_infos', function (Blueprint $table) {
    
      $table->increments('id');
      $table->integer('oid');
      $table->integer('rid');
      $table->integer('cid');
      $table->integer('discount');
      $table->integer('active');
      $table->string('ext_0')->nullable();
      $table->string('ext_1')->nullable();
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
    Schema::drop('order_infos');
	}

}
