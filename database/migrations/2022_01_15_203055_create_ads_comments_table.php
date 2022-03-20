<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('ads_comments')) {
            return;
        }

		Schema::create('ads_comments', function(Blueprint $table)
		{
			$table->integer('comment_id', true);
			$table->integer('ads_id');
			$table->integer('user_id');
			$table->text('comment_text');
			$table->boolean('is_reported');
			$table->boolean('is_reported_by_owner');
			$table->integer('total_reports_count');
			$table->boolean('hide_comment');
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ads_comments');
	}

}
