<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddErrorHtmlToProxiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('proxies', function(Blueprint $table)
		{
			$table->mediumText('error_html')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('proxies', function(Blueprint $table)
		{
			$table->dropColumn('error_html');
		});
	}

}
