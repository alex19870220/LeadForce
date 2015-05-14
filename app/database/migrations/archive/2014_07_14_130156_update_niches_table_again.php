<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateNichesTableAgain extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Update Niches
		Schema::table('niches', function(Blueprint $table)
		{
			$table->dropColumn('template');
			$table->string('keyword_main')->after('sidebar_id')->index();
		});

		// Update Projects
		Schema::table('projects', function(Blueprint $table)
		{
			$table->string('template')->after('website_url');
			$table->text('options')->after('niche_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->string('template')->after('sidebar_id');
			$table->dropIndex('keyword_main_index');
			$table->dropColumn('keyword_main');
		});

		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropColumn('template', 'options');
		});
	}

}
