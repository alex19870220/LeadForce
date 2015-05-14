<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSlugToSidebarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sidebars', function(Blueprint $table)
		{
			$table->string('slug')->index()->after('label');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sidebars', function(Blueprint $table)
		{
			$table->dropColumn('slug');
		});
	}

}
