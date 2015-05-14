<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUserIdToNichesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned()->nullable()->index()->after('id');
		});

		// Foreign key
		Schema::table('niches', function(Blueprint $table)
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
		Schema::table('niches', function(Blueprint $table)
		{
			$table->dropColumn('user_id');
		});
	}

}
