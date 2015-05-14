<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNicheToIndexerCampaigns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->string('niche')->after('project_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->dropColumn('niche');
		});
	}

}
