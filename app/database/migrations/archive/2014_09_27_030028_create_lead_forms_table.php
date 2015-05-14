<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeadFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lead_forms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('label');
			$table->string('title');
			$table->text('form_raw_html');
			$table->string('form_action');
			$table->text('fields');
			$table->text('form_data');
			$table->string('style');
		});

		// Foreign key
		Schema::table('lead_forms', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lead_forms');
	}

}
