<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('orders')) {
            return;
        }

		Schema::create('orders', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('order_type', 10)->comment('auction or deal');
			$table->integer('order_type_id')->comment('auction_id or deal_id');
			$table->integer('user_id')->index('user_id');
			$table->string('order_status', 50);
			$table->integer('item_quantity');
			$table->decimal('item_unit_price', 12);
			$table->decimal('total_items_price', 12);
			$table->decimal('order_shipping_amount', 12);
			$table->decimal('order_taxes_amount', 12);
			$table->decimal('order_total_amount', 12);
			$table->integer('payment_method_id');
			$table->boolean('order_is_paid');
			$table->integer('online_payment_transaction_id')->nullable();
			$table->text('order_shipping_address');
			$table->text('order_system_delivery_notes')->nullable()->comment('ملاحظات من النظام لتتبع الطلب');
			$table->string('canceled_by_user_type', 10)->nullable()->comment('user or system');
			$table->integer('canceled_by_user_id')->nullable();
			$table->dateTime('canceled_at')->nullable();
			$table->text('cancellation_reason');
			$table->boolean('order_is_refunded')->comment('هل تم ارجاع المبلغ في حاله لو بطاقه اليكترونيه');
			$table->text('order_notes');
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
		Schema::drop('orders');
	}

}
