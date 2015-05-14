<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddConversionsAndHitsToOptinFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->integer('views')->unsigned()->default(0);
			$table->integer('conversions')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->dropColumn('views', 'conversions');
		});
	}

}
