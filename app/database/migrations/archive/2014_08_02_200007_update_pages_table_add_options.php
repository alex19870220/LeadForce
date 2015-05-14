<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdatePagesTableAddOptions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pages', function(Blueprint $table)
		{
			$table->integer('sidebar_id')->unsigned()->index()->after('page_order');
			$table->text('options')->after('sidebar_id');
			$table->string('menu_label')->after('content');
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
			$table->dropColumn('sidebar_id', 'options', 'menu_label');
		});
	}

}
