<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReceiverInfos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('receiver_infos', function (Blueprint $table) {
    
      $table->increments('id');
      $table->integer('uid');
      $table->string('name', 100);
      $table->string('contact', 100);
      $table->integer('country')->nullable();
      $table->integer('province');
      $table->integer('city');
      $table->integer('district');
      $table->integer('road');
      $table->string('addr_num', 200);
      $table->string('address', 500);
      $table->string('comment', 200);
      $table->string('ext_0', 200);
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
    Schema::drop('receiver_infos');
	}

}
