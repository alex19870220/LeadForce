<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOptinFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('optin_forms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->string('type')->index();
			$table->string('label');
			$table->string('title')->nullable();
			$table->string('sub_text')->nullable();
			$table->text('form_data')->nullable();
		});

		// Foreign Keys
		Schema::table('optin_forms', function($table) {
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
		Schema::drop('optin_forms');
	}

}
