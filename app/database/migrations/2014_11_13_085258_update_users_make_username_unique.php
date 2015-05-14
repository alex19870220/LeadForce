<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateUsersMakeUsernameUnique extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('username');
		});

		Schema::table('users', function(Blueprint $table)
		{
			$table->string('username')->unique()->nullable()->after('email');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn('username');
		});

		Schema::table('users', function(Blueprint $table)
		{
			$table->string('username')->index()->nullable()->after('email');
		});
	}

}
