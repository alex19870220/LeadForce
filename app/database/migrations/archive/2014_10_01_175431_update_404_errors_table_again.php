<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Update404ErrorsTableAgain extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('404_errors', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `404_errors` MODIFY `project_id` INT(10) UNSIGNED NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('404_errors', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `404_errors` MODIFY `project_id` INT(10) UNSIGNED NOT NULL');
		});
	}

}
