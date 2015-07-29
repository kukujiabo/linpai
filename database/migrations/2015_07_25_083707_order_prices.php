<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderPrices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
    Schema::create('order_prices', function (Blueprint $table) {
    
      $table->increments('id');
      $table->integer('oid');
      $table->integer('orig_price');
      $table->integer('cut_fee');
      $table->integer('extra_fee');
      $table->integer('final_price');
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
    Schema::drop('order_prices');
	}

}
