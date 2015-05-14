<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('status_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->text('body');
			$table->timestamps();
		});

		// Foreign keys
		Schema::table('comments', function(Blueprint $table)
		{
			$table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
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
		Schema::drop('comments');
	}

}
