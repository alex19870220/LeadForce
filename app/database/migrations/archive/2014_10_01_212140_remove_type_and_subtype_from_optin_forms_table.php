<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveTypeAndSubtypeFromOptinFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->renameColumn('type', 'style');
			$table->dropColumn('subtype');
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
			$table->renameColumn('style', 'type');
			$table->string('subtype')->after('type');
		});
	}

}
