<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderBounsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_bouns', function(Blueprint $table)
		{
			$table->increments('id');
      $table->integer('oid');
      $table->integer('uid');
      $table->integer('bid');
      $table->integer('success');
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
		Schema::drop('order_bouns');
	}

}
