<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('deals')) {
            return;
        }

		Schema::create('deals', function(Blueprint $table)
		{
			$table->integer('deal_id', true);
			$table->integer('user_id')->nullable()->comment('if null it will be from system	');
			$table->integer('city_id');
			$table->string('deal_allowed_payment_method_ids', 250);
			$table->text('deal_title');
			$table->text('deal_description');
			$table->text('deal_img_obj');
			$table->text('deal_slider');
			$table->string('deal_target_type', 100)->comment('المميزين او اصحاب الرصيجد بالمحفظه او للجميع');
			$table->decimal('deal_unit_price', 12);
			$table->integer('deal_total_quantity')->comment('الكميه الاساسية للصفقه');
			$table->integer('deal_bought_quantity')->comment('الكميه المباعه');
			$table->dateTime('deal_start_at')->nullable();
			$table->dateTime('deal_end_at')->nullable();
			$table->boolean('deal_is_active');
			$table->integer('deal_max_sell_quantity_for_normal_user')->comment('اقصي كميه للشراء لليوزر العادي');
			$table->integer('deal_max_sell_quantity_for_premium_user')->comment('اقصي كميه للشراء لليوزر المميز');
			$table->decimal('deal_shipping_price', 12)->comment('سعر الشحن لغير المميزين');
			$table->decimal('auction_require_amount_in_wallet', 12)->comment('يجب توافر مبلغ معين في المحفظه لكي يشتري الصفقه');
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
		Schema::drop('deals');
	}

}
