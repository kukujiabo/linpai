<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxpayOrderCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('wxpay_order_codes', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('order_code');
      $table->string('uid');
      $table->string('wx_code');
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
		Schema::drop('wxpay_order_codes');
	}

}
