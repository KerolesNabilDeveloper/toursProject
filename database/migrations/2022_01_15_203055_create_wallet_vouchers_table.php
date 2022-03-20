<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('wallet_vouchers')) {
            return;
        }

		Schema::create('wallet_vouchers', function(Blueprint $table)
		{
			$table->integer('voucher_id', true);
			$table->text('voucher_title');
			$table->string('voucher_code', 100)->index('voucher_code');
			$table->integer('voucher_usage_limit');
			$table->integer('voucher_used_count');
			$table->dateTime('voucher_start_at')->nullable();
			$table->dateTime('voucher_end_at')->nullable();
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
		Schema::drop('wallet_vouchers');
	}

}
