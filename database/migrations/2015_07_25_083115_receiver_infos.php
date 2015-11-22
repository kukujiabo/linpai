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
      $table->string('receiver', 100);
      $table->string('mobile', 100);
      $table->string('phone', 100)->nullable();
      $table->string('country')->nullable();
      $table->string('province')->nullable();
      $table->string('city')->nullable();
      $table->string('district')->nullable();
      $table->string('road')->nullable();
      $table->string('post_code', 200)->nullable();
      $table->string('address', 500)->nullable();
      $table->string('comment', 200)->nullable();
      $table->string('ext_0', 200)->nullable();
      $table->integer('last_used')->nullable();
      $table->integer('active')->default(1);
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
