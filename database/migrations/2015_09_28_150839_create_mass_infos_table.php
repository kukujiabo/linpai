<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMassInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mass_infos', function(Blueprint $table)
		{
			$table->increments('id');
      $table->string('title');
      $table->string('content');
      $table->string('code')->unique();
      $table->string('comment')->nullable();
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
		Schema::drop('mass_infos');
	}

}
