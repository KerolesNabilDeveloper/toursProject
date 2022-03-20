<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRatingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('user_ratings')) {
            return;
        }

		Schema::create('user_ratings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('rater_id');
			$table->decimal('rate_value', 10);
			$table->boolean('deal_before_with_user')->comment('التعامل السايق مع المعلن');
			$table->boolean('is_recommended')->comment('ترشيح المعلن');
			$table->text('review_text');
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
		Schema::drop('user_ratings');
	}

}
