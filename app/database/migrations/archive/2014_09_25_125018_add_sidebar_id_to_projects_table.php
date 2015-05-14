<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSidebarIdToProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->integer('sidebar_id')->unsigned()->nullable()->index()->after('tracking_id');
			$table->dropColumn('separator');
		});

		// Foreign key
		Schema::table('projects', function(Blueprint $table)
		{
			$table->foreign('sidebar_id')->references('id')->on('sidebars')->onDelete('cascade');
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
			$table->dropForeign('projects_sidebar_id_foreign');
		});

		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropColumn('sidebar_id');
		});
	}

}
