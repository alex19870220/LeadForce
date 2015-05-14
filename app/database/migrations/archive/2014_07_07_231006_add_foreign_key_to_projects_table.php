<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeyToProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropColumn('niche');
			$table->integer('niche_id')->unsigned()->nullable()->after('website_url');
			$table->index('niche_id');
		});

		// Now to add the foreign key....
		Schema::table('projects', function(Blueprint $table)
		{
			$table->foreign('niche_id')->references('id')->on('niches')->onDelete('cascade');
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
			//$table->dropForeign('projects_niche_id_foreign');
		});

		// Why?!?!?
		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropIndex('niche_id');
			$table->dropColumn('niche_id');
			$table->string('niche')->after('website_url');
		});
	}

}
