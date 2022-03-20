<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('auction_subscribers')) {
            return;
        }

		Schema::create('auction_subscribers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('auction_id');
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
		Schema::drop('auction_subscribers');
	}

}
