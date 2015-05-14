<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateNichesTableMakeExcerptNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `niches` MODIFY `excerpt` TEXT NULL DEFAULT NULL');
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
			DB::statement('ALTER TABLE `niches` MODIFY `excerpt` TEXT NOT NULL;');
		});
	}

}
