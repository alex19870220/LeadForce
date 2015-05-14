<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateSidebarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sidebars', function(Blueprint $table)
		{
			$table->renameColumn('widgets', 'widgets_list');
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
			$table->renameColumn('widgets_list', 'widgets');
		});
	}

}
