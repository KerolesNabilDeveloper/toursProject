<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealNotifiersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('deal_notifiers')) {
            return;
        }

		Schema::create('deal_notifiers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('deal_id');
			$table->integer('user_id');
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('deal_notifiers');
	}

}
