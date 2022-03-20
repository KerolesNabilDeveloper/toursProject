<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionBiddingLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('auction_bidding_log')) {
            return;
        }

		Schema::create('auction_bidding_log', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('auction_id');
			$table->integer('user_id');
			$table->decimal('bidding_amount', 12);
			$table->dateTime('bid_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('auction_bidding_log');
	}

}
