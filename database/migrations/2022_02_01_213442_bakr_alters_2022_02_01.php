<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BakrAlters20220201 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('auctions', 'auction_tax_number')) {
            DB::statement("
                ALTER TABLE `auctions` ADD `auction_tax_number` VARCHAR(200) NOT NULL AFTER `auction_is_active`;
            ");

        }

        if (!Schema::hasColumn('deals', 'deal_tax_number')) {
            DB::statement("
                ALTER TABLE `deals` ADD `deal_tax_number` VARCHAR(200) NOT NULL AFTER `deal_end_at`;
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
