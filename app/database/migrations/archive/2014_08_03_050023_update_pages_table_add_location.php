<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePagesTableAddLocation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pages', function(Blueprint $table)
		{
			$table->string('layout')->after('content');
			$table->string('location')->index()->after('menu_label');
			$table->string('icon')->after('menu_label');
			$table->boolean('active')->index()->after('options');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pages', function(Blueprint $table)
		{
			$table->dropColumn('location', 'icon', 'active', 'layout');
		});
	}

}
