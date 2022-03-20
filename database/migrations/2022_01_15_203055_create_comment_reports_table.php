<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('comment_reports')) {
            return;
        }

		Schema::create('comment_reports', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('comment_id');
			$table->integer('user_id');
			$table->text('report_reason');
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
		Schema::drop('comment_reports');
	}

}
