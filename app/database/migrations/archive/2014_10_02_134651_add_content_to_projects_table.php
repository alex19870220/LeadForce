<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddContentToProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->text('content')->after('niche_id');
		});

		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->dropColumn('style');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropColumn('content');
		});

		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->string('style')->after('id');
		});
	}

}
