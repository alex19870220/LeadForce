<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Create404ErrorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('404_errors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->string('domain')->index()->nullable();
			$table->string('path')->index()->nullable();
			$table->boolean('redirect_enabled')->default(0);
			$table->string('redirect_url')->nullable();
			$table->integer('hits')->unsigned()->index();
			$table->timestamps();
		});

		// Foreign Keys
		Schema::table('404_errors', function(Blueprint $table)
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
		Schema::drop('404_errors');
	}

}
