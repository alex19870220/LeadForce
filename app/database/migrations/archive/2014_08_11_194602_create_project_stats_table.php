<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectStatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('project_stats', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->integer('index_count');
			$table->integer('page_count');
			$table->text('pagerank');
			$table->text('moz');
			$table->text('majestic');
			$table->text('ahrefs');
			$table->timestamps();
		});

		// Now to add the foreign key....
		Schema::table('project_stats', function(Blueprint $table)
		{
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('project_stats');
	}

}
