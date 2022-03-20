<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BakrAlters20220125 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('auctions', 'auction_timer_end_at')) {
            DB::statement("
                ALTER TABLE `auctions` ADD `auction_timer_end_at` DATETIME NULL AFTER `auction_start_at`;
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
