<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProjectIdToIndexerCampaignsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->integer('project_id')->after('id')->unsigned()->index();
		});

		// Now to add the foreign keys....
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
			// Remove project_id
			$table->dropForeign('indexer_campaigns_project_id_foreign');
			$table->dropColumn('project_id');
		});
	}

}
