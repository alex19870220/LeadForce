<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateNichesTableSlug extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->string('slug')->index()->after('label');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->dropColumn('slug');
		});
	}

}
