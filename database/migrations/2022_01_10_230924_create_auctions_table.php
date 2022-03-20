<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuctionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('auctions')) {
            return;
        }

		Schema::create('auctions', function(Blueprint $table)
		{
			$table->integer('auction_id', true);
			$table->integer('user_id')->nullable()->comment('if null it will be from system');
			$table->string('auction_type', 100)->comment('مزاد عام او خاص');
			$table->integer('city_id');
			$table->text('auction_title');
			$table->text('auction_img_obj');
			$table->text('auction_slider');
			$table->text('auction_description');
			$table->decimal('auction_require_prequel_insurance_amount', 12);
			$table->decimal('auction_require_amount_in_wallet', 12);
			$table->string('auction_allowed_payment_method_ids', 250);
			$table->decimal('auction_start_price', 12)->comment('سعر بدأ  المزاد');
			$table->decimal('auction_min_sell_price', 12)->comment('اقل سعر لبيع المزاد');
			$table->decimal('auction_max_sell_price', 12)->comment('اعلي سعر لبيع المزاد');
			$table->decimal('auction_min_bid', 12)->comment('اقل مزايده');
			$table->decimal('auction_max_bid', 12);
			$table->integer('auction_timer_minute')->comment('العدادا بالدقايق بعد اول مزايده');
			$table->dateTime('auction_start_at')->nullable();
			$table->boolean('auction_is_active');
			$table->boolean('auction_is_finished')->comment('لما المزاد ينتهي سواء بفائز او من خلال الادمن');
			$table->dateTime('auction_finished_at')->nullable();
			$table->integer('auction_winner_user_id');
			$table->decimal('auction_winning_price', 12);
			$table->integer('auction_last_bidder_id');
			$table->decimal('auction_last_bidding_amount', 12);
			$table->integer('auction_total_subscribers_count');
			$table->integer('auction_total_bidders_count');
			$table->timestamps();
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
		Schema::drop('auctions');
	}

}
