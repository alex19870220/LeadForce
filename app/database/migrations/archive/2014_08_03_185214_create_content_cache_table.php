<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentCacheTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('content_cache', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->integer('state_id')->unsigned()->index();
			$table->integer('city_id')->unsigned()->index();
			$table->integer('niche_id')->unsigned()->index();
			$table->text('content');
			$table->timestamps();
		});

		Schema::table('content_cache', function(Blueprint $table)
		{
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->foreign('state_id')->references('id')->on('geo_states')->onDelete('cascade');
			$table->foreign('city_id')->references('id')->on('geo_cities')->onDelete('cascade');
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
		Schema::drop('content_cache');
	}

}