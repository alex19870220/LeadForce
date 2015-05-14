<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeoCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geo_cities', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('state_id')->unsigned();
			$table->string('city')->nullable();
			$table->text('postal_codes');
			$table->timestamps();
		});

		// Indexes & Keys
		Schema::table('geo_cities', function($table) {
			$table->index('state_id');
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
		Schema::drop('geo_cities');
	}

}