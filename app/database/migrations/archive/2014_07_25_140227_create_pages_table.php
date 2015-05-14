<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->nullable()->index();
			$table->string('title');
			$table->string('slug')->index();
			$table->text('content');
			$table->integer('page_order')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('pages', function(Blueprint $table)
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
		Schema::drop('pages');
	}

}
