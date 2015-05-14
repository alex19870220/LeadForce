<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateNichesTableMakeMetasNullable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `niches` MODIFY `meta_title` VARCHAR(60) NULL DEFAULT NULL');
			DB::statement('ALTER TABLE `niches` MODIFY `meta_description` VARCHAR(160) NULL DEFAULT NULL');
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
			DB::statement('ALTER TABLE `niches` MODIFY `meta_title` VARCHAR(60) NOT NULL');
			DB::statement('ALTER TABLE `niches` MODIFY `meta_description` VARCHAR(160) NOT NULL');
		});
	}

}
