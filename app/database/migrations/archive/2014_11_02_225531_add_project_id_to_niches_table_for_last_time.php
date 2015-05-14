<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProjectIdToNichesTableForLastTime extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->integer('project_id')->nullable()->unsigned()->index()->after('id');
		});

		// Foreign key
		Schema::table('niches', function(Blueprint $table)
		{
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop foreign key
		Schema::table('niches', function(Blueprint $table)
		{
			$table->dropForeign('niches_project_id_foreign');
		});

		Schema::table('niches', function(Blueprint $table)
		{
			$table->dropColumn('project_id');
		});
	}

}
