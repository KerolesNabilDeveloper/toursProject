<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('memberships')) {
            return;
        }

		Schema::create('memberships', function(Blueprint $table)
		{
			$table->integer('membership_id', true);
			$table->text('membership_title');
			$table->decimal('membership_price', 12);
			$table->integer('membership_valid_days');
			$table->text('membership_permissions');
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
		Schema::drop('memberships');
	}

}
