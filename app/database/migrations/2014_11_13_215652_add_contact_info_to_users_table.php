<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddContactInfoToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->text('contact_info')->after('website')->nullable();
			$table->dropColumn('created_at', 'updated_at', 'deleted_at');
		});

		// Add timestamps/deleted at to bottom
		Schema::table('users', function(Blueprint $table)
		{
			$table->timestamps();
			$table->softDeletes();
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
			$table->dropColumn('contact_info');
		});
	}

}
