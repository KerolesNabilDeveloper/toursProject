<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BakrAlters20220115 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasColumn('auctions', 'seller_name')) {
            DB::statement("
                ALTER TABLE `auctions` ADD `seller_name` VARCHAR(100) NOT NULL COMMENT 'اسم البائع في حاله user_id is null' AFTER `user_id`;
            ");

        }

        if (!Schema::hasColumn('users', 'user_total_rate_sum')) {
            DB::statement("
                ALTER TABLE `users` ADD `user_total_rate_sum` DECIMAL(10,2) NOT NULL AFTER `is_active`, ADD `user_total_rate_count` INT NOT NULL AFTER `user_total_rate_sum`, ADD `user_total_rate_avg` DECIMAL(10,2) NOT NULL AFTER `user_total_rate_count`;
            ");

        }

        if (!Schema::hasColumn('users', 'whatsapp_phone')) {
            DB::statement("
                ALTER TABLE `users` ADD `whatsapp_phone` VARCHAR(100) NOT NULL COMMENT 'with code' AFTER `temp_phone`;
            ");

        }

        if (!Schema::hasColumn('deals', 'seller_name')) {
            DB::statement("
                ALTER TABLE `deals` ADD `seller_name` VARCHAR(100) NOT NULL COMMENT 'اسم البائع في حاله user_id is null' AFTER `user_id`;
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
