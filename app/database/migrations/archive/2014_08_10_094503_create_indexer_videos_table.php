<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIndexerVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Indexer campaigns
		Schema::create('indexer_campaigns', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('project_id')->unsigned()->index();
			$table->boolean('active')->index();
			$table->boolean('complete')->index();
			$table->text('index_chart');
			$table->timestamps();
		});

		// Videos database
		Schema::create('indexer_videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('campaign_id')->unsigned()->index();
			$table->mediumText('videos');
			$table->integer('video_count');
			$table->string('niche');
			$table->timestamps();
		});

		// Now to add the foreign keys....
		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});

		Schema::table('indexer_videos', function(Blueprint $table)
		{
			$table->foreign('campaign_id')->references('id')->on('indexer_campaigns')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('indexer_videos');

		Schema::drop('indexer_campaigns');
	}

}
