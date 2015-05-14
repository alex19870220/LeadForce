<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProjectsTableSlugWidgets extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->text('widgets_sidebar')->after('options');
			$table->text('widgets_footer')->after('widgets_sidebar');
			$table->string('tracking_id')->after('options');
			$table->string('slug')->after('website_url')->index();
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
			$table->dropColumn('widgets_sidebar', 'widgets_footer', 'tracking_id', 'slug');
		});
	}

}
