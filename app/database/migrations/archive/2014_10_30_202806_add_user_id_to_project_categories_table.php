<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserIdToProjectCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('project_categories', function(Blueprint $table)
		{
			$table->integer('owner_id')->unsigned()->index()->nullable();
			$table->text('shared_access')->nullable();
		});

		// Foreign key
		Schema::table('project_categories', function(Blueprint $table)
		{
			$table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::table('project_categories', function(Blueprint $table)
		{
			$table->dropForeign('project_categories_owner_id_foreign');
		});

		Schema::table('project_categories', function(Blueprint $table)
		{
			$table->dropColumn('owner_id', 'shared_access');
		});
	}

}
