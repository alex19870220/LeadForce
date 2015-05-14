<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProxiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proxies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('ip', 20)->index();
			$table->integer('port');
			$table->string('username', 40);
			$table->string('password', 40);
			$table->boolean('active')->index();
			$table->timestamp('last_used')->index();
			$table->string('last_result', 20);
			$table->integer('last_load_time');
		});

		// Now to add the foreign keys....
		Schema::table('proxies', function(Blueprint $table)
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
		Schema::drop('proxies');
	}

}
