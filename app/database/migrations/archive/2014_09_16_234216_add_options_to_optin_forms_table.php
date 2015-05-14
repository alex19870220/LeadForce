<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOptionsToOptinFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('optin_forms', function(Blueprint $table)
		{
			$table->text('options');
			$table->string('subtype')->nullable()->index()->after('type');
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
			$table->dropColumn('options', 'subtype');
		});
	}

}
