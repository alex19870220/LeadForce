<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateNichesMakeContentNullable102814 extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches_make_content_nullable_102814', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `niches` MODIFY `content` TEXT NULL DEFAULT NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('niches_make_content_nullable_102814', function(Blueprint $table)
		{
			DB::statement('ALTER TABLE `niches` MODIFY `content` TEXT NOT NULL;');
		});
	}

}
