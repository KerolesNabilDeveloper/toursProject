<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BakrAlters20220127 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasColumn('wallet_vouchers', 'is_active')) {
            DB::statement("
                ALTER TABLE `wallet_vouchers` ADD `is_active` BOOLEAN NOT NULL AFTER `voucher_end_at`;
            ");

        }

        if (!Schema::hasColumn('wallet_vouchers', 'voucher_amount')) {
            DB::statement("
                ALTER TABLE `wallet_vouchers` ADD `voucher_amount` DECIMAL(12,2) NOT NULL AFTER `voucher_end_at`;
            ");

        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
