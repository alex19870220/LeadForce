<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeoCountiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geo_counties', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('state_id')->unsigned()->index();
			$table->string('county');
			$table->string('slug')->index();
		});

		// Foreign Keys
		Schema::table('geo_counties', function($table) {
			$table->foreign('state_id')->references('id')->on('geo_states')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop foreign?
		Schema::table('geo_counties', function($table) {
			//
		});

		Schema::drop('geo_counties');
	}

}
