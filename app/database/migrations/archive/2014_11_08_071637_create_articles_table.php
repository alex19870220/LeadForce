<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('title_original')->nullable();
			$table->string('title_spintax')->nullable();
			$table->text('content_original')->nullable();
			$table->text('content_spintax')->nullable();
			$table->string('quality')->nullable();
			$table->integer('uniqueness')->nullable();
			$table->boolean('turing')->default(1);
			$table->boolean('sentence')->default(1)->index();
			$table->boolean('paragraph')->default(0)->index();
			$table->boolean('finished')->default(0)->index();
			$table->boolean('errors')->default(0)->index();
			$table->timestamps();
		});

		// Foreign keys
		Schema::table('articles', function(Blueprint $table)
		{
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articles');
	}

}
