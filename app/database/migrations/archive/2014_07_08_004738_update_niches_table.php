<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateNichesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->integer('parent_id')->unsigned()->nullable()->index()->after('label');
			$table->integer('sidebar_id')->unsigned()->nullable()->index()->after('parent_id');
			$table->text('titles')->after('keywords');
			$table->text('excerpt')->after('titles');
			$table->text('content')->after('excerpt');
			$table->string('content_type')->nullable()->after('content');
			$table->string('meta_title', 60)->after('content_type');
			$table->string('meta_description', 160)->after('meta_title');
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('niches', function(Blueprint $table)
		{
			$table->dropColumn('parent_id', 'sidebar_id', 'titles', 'excerpt', 'content', 'content_type', 'meta_title', 'meta_description');
			$table->dropColumn('deleted_at');
		});
	}

}
