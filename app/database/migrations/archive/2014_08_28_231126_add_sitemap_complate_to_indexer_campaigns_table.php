<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSitemapComplateToIndexerCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->boolean('sitemap_complete')->after('complete');
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
			$table->dropColumn('sitemap_complete');
		});
	}

}
