<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliverInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deliver_infos', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('company');
      $table->string('code');
      $table->string('operator_id')->nullable();
      $table->string('order_code');
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
		Schema::drop('deliver_infos');
	}

}
