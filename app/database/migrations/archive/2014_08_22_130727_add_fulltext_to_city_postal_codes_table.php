<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFulltextToCityPostalCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('geo_cities', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `geo_cities` ADD FULLTEXT zip_search(`postal_codes`)');

			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('geo_countries', function(Blueprint $table)
		{
			$table->dropColumn('created_at', 'updated_at');
		});

		Schema::table('geo_states', function(Blueprint $table)
		{
			$table->dropColumn('created_at', 'updated_at');
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
			$table->dropIndex('zip_search');
			$table->timestamps();
		});

		Schema::table('geo_countries', function(Blueprint $table)
		{
			$table->timestamps();
		});

		Schema::table('geo_states', function(Blueprint $table)
		{
			$table->timestamps();
		});
	}

}
