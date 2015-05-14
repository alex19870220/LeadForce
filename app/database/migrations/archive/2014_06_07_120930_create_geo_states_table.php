<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeoStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geo_states', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->string('state')->nullable();
			$table->string('abbr')->nullable();
			$table->timestamps();
		});

		// Indexes & Keys
		Schema::table('geo_states', function($table) {
			$table->unique('state');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('geo_states');
	}

}