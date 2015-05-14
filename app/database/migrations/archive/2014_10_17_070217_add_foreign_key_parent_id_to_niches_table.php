<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeyParentIdToNichesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->foreign('parent_id')->references('id')->on('niches')->onDelete('cascade');
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
			$table->dropForeign('niches_parent_id_foreign');
		});
	}

}
