<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealBuyersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('deal_buyers')) {
            return;
        }

		Schema::create('deal_buyers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('deal_id');
			$table->integer('user_id');
			$table->integer('bought_quantity');
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
		Schema::drop('deal_buyers');
	}

}
