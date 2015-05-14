<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_friends', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('follower_id')->unsigned()->index();
			$table->integer('followed_id')->unsigned()->index();
			$table->timestamps();
		});

		// Foreign keys
		Schema::table('users_friends', function(Blueprint $table)
		{
			$table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('followed_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_friends');
	}

}
