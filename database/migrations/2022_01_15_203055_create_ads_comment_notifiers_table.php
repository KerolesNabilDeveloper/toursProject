<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsCommentNotifiersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('ads_comment_notifiers')) {
            return;
        }

		Schema::create('ads_comment_notifiers', function(Blueprint $table)
		{
			$table->integer('id');
			$table->integer('ads_id');
			$table->integer('user_id');
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
		Schema::drop('ads_comment_notifiers');
	}

}
