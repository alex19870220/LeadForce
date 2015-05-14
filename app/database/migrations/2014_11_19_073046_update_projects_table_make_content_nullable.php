<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProjectsTableMakeContentNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `projects` MODIFY `content` TEXT NULL DEFAULT NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `about` TEXT NULL DEFAULT NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `options` TEXT NULL DEFAULT NULL');
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
			DB::statement('ALTER TABLE `projects` MODIFY `content` TEXT NULL DEFAULT NOT NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `about` TEXT NULL DEFAULT NOT NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `options` TEXT NULL DEFAULT NOT NULL');
		});
	}

}
