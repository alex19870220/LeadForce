<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/*Schema::create('content', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->string('label');
			$table->text('keywords');
			$table->text('titles');
			$table->text('excerpt');
			$table->string('content_type');
			$table->text('content');
			$table->text('urls');
			$table->text('meta_tags');
			$table->timestamps();
		});*/
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		/*Schema::drop('content');*/
	}

}
