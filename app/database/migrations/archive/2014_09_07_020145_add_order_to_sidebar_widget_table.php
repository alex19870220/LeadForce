<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddOrderToSidebarWidgetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sidebar_widget', function(Blueprint $table)
		{
			$table->integer('widget_order')->unsigned()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sidebar_widget', function(Blueprint $table)
		{
			$table->dropIndex('sidebar_widget_widget_order_index');
		});

		Schema::table('sidebar_widget', function(Blueprint $table)
		{
			$table->dropColumn('widget_order');
		});
	}

}
