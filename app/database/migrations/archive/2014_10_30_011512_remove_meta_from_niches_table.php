<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveMetaFromNichesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->dropColumn('meta_title', 'meta_description');
			$table->text('meta')->after('content_type')->nullable();
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
			$table->dropColumn('meta');
			$table->string('meta_title', 60)->after('content_type');
			$table->string('meta_description', 160)->after('meta_title');
		});
	}

}
