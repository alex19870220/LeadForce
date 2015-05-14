<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptinFormProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('optin_form_project', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('optin_form_id')->unsigned()->index();
			$table->foreign('optin_form_id')->references('id')->on('optin_forms')->onDelete('cascade');
			$table->integer('project_id')->unsigned()->index();
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('optin_form_project');
	}

}
