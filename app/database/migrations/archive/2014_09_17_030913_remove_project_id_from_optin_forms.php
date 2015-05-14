<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveProjectIdFromOptinForms extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->dropForeign('optin_forms_project_id_foreign');
		});

		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->dropColumn('project_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->integer('project_id')->unsigned()->index();
		});

		// Foreign Keys
		Schema::table('optin_forms', function($table) {
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
	}

}
