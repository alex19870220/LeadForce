<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddKeywordsToIndexerVideos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('indexer_videos', function(Blueprint $table)
		{
			$table->dropColumn('niche');
			$table->text('keywords')->after('video_count');
			$table->integer('keyword_count')->after('keywords');
		});

		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->string('status')->after('niche_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('indexer_videos', function(Blueprint $table)
		{
			$table->dropColumn('keyword_count', 'keywords');
		});

		Schema::table('indexer_campaigns', function(Blueprint $table)
		{
			$table->dropColumn('status');
		});
	}

}
