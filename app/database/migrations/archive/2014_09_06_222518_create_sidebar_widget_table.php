<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSidebarWidgetTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sidebar_widget', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sidebar_id')->unsigned()->index();
			$table->foreign('sidebar_id')->references('id')->on('sidebars')->onDelete('cascade');
			$table->integer('widget_id')->unsigned()->index();
			$table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sidebar_widget');
	}

}
