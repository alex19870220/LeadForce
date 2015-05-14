<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTriesIndexCountToProjectStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_stats', function(Blueprint $table)
		{
			$table->integer('tries_index_count')->after('index_count')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('project_stats', function(Blueprint $table)
		{
			$table->dropColumn('tries_index_count');
		});
	}

}
