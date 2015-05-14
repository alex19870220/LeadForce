<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveWidgetsFromProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropColumn('widgets_sidebar', 'widgets_footer');
			// Update tracking_id
			DB::statement('ALTER TABLE `projects` MODIFY `tracking_id` INT(10) UNSIGNED NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `niche_id` INT(10) UNSIGNED NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `template` VARCHAR(255) NULL');
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
			$table->text('widgets_sidebar')->after('options');
			$table->text('widgets_footer')->after('widgets_sidebar');
			// Update tracking_id
			DB::statement('ALTER TABLE `projects` MODIFY `tracking_id` VARCHAR(255) NOT NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `niche_id` INT(10) UNSIGNED NOT NULL');
			DB::statement('ALTER TABLE `projects` MODIFY `template` VARCHAR(255) NOT NULL');
		});
	}

}
