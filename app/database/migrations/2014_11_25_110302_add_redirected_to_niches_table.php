<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRedirectedToNichesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->boolean('redirected')->after('stats')->index()->default(0);
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
			$table->dropColumn('redirected');
		});
	}

}
