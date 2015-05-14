<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLetterToGeoCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('geo_cities', function(Blueprint $table)
		{
			$table->string('letter')->after('slug')->index();
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
			$table->dropColumn('letter');
		});
	}

}
