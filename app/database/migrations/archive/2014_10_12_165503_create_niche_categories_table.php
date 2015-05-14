<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNicheCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('label');
		});

		Schema::table('projects', function(Blueprint $table)
		{
			$table->integer('category_id')->unsigned()->nullable()->index()->after('created_by');
		});

		// Foreign key
		Schema::table('projects', function(Blueprint $table)
		{
			$table->foreign('category_id')->references('id')->on('project_categories')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_categories');

		Schema::table('projects', function(Blueprint $table)
		{
			$table->dropColumn('category_id');
		});
	}

}
