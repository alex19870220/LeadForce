<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsenseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
		 * Adsense Table
		 */
		Schema::create('adsense', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('publisher_id');
			$table->text('ads');
			$table->text('options');
			$table->string('channel');
			$table->timestamps();
		});

		// Foreign key
		Schema::table('adsense', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});

		/**
		 * Projects Table
		 */
		Schema::table('projects', function(Blueprint $table)
		{
			$table->integer('adsense_id')->unsigned()->nullable()->index()->after('sidebar_id');
		});

		// Foreign key
		Schema::table('projects', function(Blueprint $table)
		{
			$table->foreign('adsense_id')->references('id')->on('adsense')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adsense');
	}

}
