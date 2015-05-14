<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNicheToIndexerVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*
		| Indexer Videos
		*/
		Schema::table('indexer_videos', function(Blueprint $table)
		{
			$table->integer('niche_id')->unsigned()->index()->after('campaign_id');
		});

		// Now to add the foreign keys....
		Schema::table('indexer_videos', function(Blueprint $table)
		{
			$table->foreign('niche_id')->references('id')->on('niches')->onDelete('cascade');
		});

		/*
		| Proxies
		*/
		Schema::table('proxies', function(Blueprint $table)
		{
			$table->dropColumn('username', 'password');
		});

		Schema::table('proxies', function(Blueprint $table)
		{
			$table->string('username')->nullable()->after('port');
			$table->string('password')->nullable()->after('username');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/*
		| Indexer Videos
		*/
		Schema::table('indexer_videos', function(Blueprint $table)
		{
			// Remove project_id
			$table->dropForeign('indexer_videos_niche_id_foreign');
			$table->dropColumn('niche_id');
		});

		/*
		| Proxies
		*/
		Schema::table('proxies', function(Blueprint $table)
		{
			$table->dropColumn('username', 'password');
		});

		Schema::table('proxies', function(Blueprint $table)
		{
			$table->string('username')->after('port');
			$table->string('password')->after('username');
		});
	}

}
