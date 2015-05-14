<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProxiesTableChangeLastLoadTimeToDec extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proxies', function(Blueprint $table)
		{
			$table->dropColumn('last_load_time');
		});

		Schema::table('proxies', function(Blueprint $table)
		{
			$table->string('last_load_time');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('proxies', function(Blueprint $table)
		{
			$table->dropColumn('last_load_time');
		});

		Schema::table('proxies', function(Blueprint $table)
		{
			$table->integer('last_load_time');
		});
	}

}
