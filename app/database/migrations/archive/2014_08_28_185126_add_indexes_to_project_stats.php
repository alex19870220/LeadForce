<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddIndexesToProjectStats extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_stats', function(Blueprint $table)
		{
			$table->index('created_at');
			$table->index('updated_at');
			$table->index('index_count');
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
			$table->dropIndex('project_stats_created_at_index');
			$table->dropIndex('project_stats_updated_at_index');
			$table->dropIndex('project_stats_index_count_index');
		});
	}

}
