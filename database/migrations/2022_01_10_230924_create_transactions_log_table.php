<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsLogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('transactions_log')) {
            return;
        }

		Schema::create('transactions_log', function(Blueprint $table)
		{
			$table->integer('t_log_id', true);
			$table->string('user_type', 20)->comment('user or agent or sys');
			$table->integer('user_id');
			$table->string('transaction_type', 50)->comment('hotel_booking,flight_booking,hotel_refund,flight_refund,b2c_available_balance, b2c_hotel_booking, b2c_flight_booking, b2c_hotel_refund, b2c_flight_refund , add_money_to_agent , confirm_offline_package , reject_offline_package');
			$table->string('transaction_operation', 20)->comment('\'increase\',\'decrease\'');
			$table->decimal('transaction_amount', 10);
			$table->string('transaction_notes', 1000);
			$table->boolean('transaction_is_temp')->nullable()->comment('if this transaction is temp and not confirmed to be real received');
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
		Schema::drop('transactions_log');
	}

}
