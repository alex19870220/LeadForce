<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('projects', function(Blueprint $table)
		{
			$table->integer('created_by')->unsigned()->index()->after('label');
			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
			$table->dropColumn('niche');
			// Need to add niche table to the database
		});
		Schema::table('projects', function(Blueprint $table)
		{
			$table->integer('niche')->unsigned()->index()->after('website_url');
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
			$table->dropColumn('created_by');
			$table->dropColumn('niche');
		});
		
		Schema::table('projects', function(Blueprint $table)
		{
			$table->integer('niche')->unsigned()->index()->after('website_url');
			
			$table->string('niche');
		});
	}

}
