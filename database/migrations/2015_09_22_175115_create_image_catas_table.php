<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageCatasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('image_catas', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('type')->unique();
      $table->string('name')->unique();
      $table->string('store_path');
      $table->string('comment');
      $table->string('ext_1');
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
		Schema::drop('image_catas');
	}

}
