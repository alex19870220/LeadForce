<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateGeoCitiesTableAddCountyId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('geo_cities', function(Blueprint $table)
		{
			$table->integer('county_id')->after('state_id')->unsigned()->nullable()->index();
		});

		Schema::table('geo_cities', function(Blueprint $table)
		{
			$table->foreign('county_id')->references('id')->on('geo_counties')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('geo_cities', function(Blueprint $table)
		{
			$table->dropColumn('county_id');
		});
	}

}
