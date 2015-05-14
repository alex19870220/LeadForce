<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('niche_id')->unsigned()->nullabe()->index();
			$table->string('label');
			$table->string('type')->index();
			$table->string('path');
			$table->integer('width')->nullable()->unsigned();
			$table->integer('height')->nullable()->unsigned();
			$table->timestamps();
		});

		Schema::table('images', function(Blueprint $table)
		{
			$table->foreign('niche_id')->references('id')->on('niches')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}
