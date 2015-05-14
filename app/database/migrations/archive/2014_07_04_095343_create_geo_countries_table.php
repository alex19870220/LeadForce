<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeoCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('geo_countries', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->string('country')->unique();
			$table->string('abbr')->unique();
			$table->timestamps();
		});

		Schema::table('geo_states', function(Blueprint $table)
		{
			$table->integer('country_id')->unsigned()->after('id');
			$table->index('country_id');
			$table->foreign('country_id')->references('id')->on('geo_countries')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('geo_states', function(Blueprint $table)
		{
			$table->dropForeign('geo_states_country_id_foreign');
			$table->dropColumn('country_id');
		});

		Schema::drop('geo_countries');
	}

}