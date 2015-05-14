<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateGeoStatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('geo_states', function(Blueprint $table)
		{
			$table->string('slug')->index()->after('state');
			$table->unique('abbr');
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
			$table->dropIndex('slug');
			$table->dropColumn('slug');
			$table->dropUnique('abbr');
		});
	}

}
