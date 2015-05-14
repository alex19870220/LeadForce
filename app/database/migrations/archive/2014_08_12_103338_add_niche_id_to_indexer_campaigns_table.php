<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNicheIdToIndexerCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			// Remove project_id
			$table->dropForeign('indexer_campaigns_project_id_foreign');
			$table->dropColumn('project_id', 'niche');

			// Add niche_id
			$table->integer('niche_id')->after('id')->unsigned()->index();

			// Rename index_chart
			$table->renameColumn('index_chart', 'index_data');
		});

		// Now to add the foreign keys....
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->foreign('niche_id')->references('id')->on('niches')->onDelete('cascade');
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
			$table->dropForeign('indexer_campaigns_niche_id_foreign');
			$table->dropColumn('niche_id');

			$table->integer('project_id')->after('id')->unsigned()->index();
			$table->string('niche')->after('project_id');

			// Rename index_chart
			$table->renameColumn('index_data', 'index_chart');
		});

		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
	}

}
