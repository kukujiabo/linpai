<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Goods extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('goods', function(Blueprint $table) {

      $table->increments('id');
      $table->string('name', 100);
      $table->string('code', 100)->unique();
      $table->string('intro', 500)->nullable();
      $table->string('pic', 200)->nullable();
      $table->string('tiny_good')->nullable();
      $table->text('comment')->nullable();
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
    Schema::drop('goods');
	}

}
