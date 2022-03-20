<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('payment_methods')) {
            return;
        }

		Schema::create('payment_methods', function(Blueprint $table)
		{
			$table->integer('payment_method_id', true);
			$table->text('payment_method_title');
			$table->text('payment_method_img_obj');
			$table->string('payment_method_type', 100)->comment('wallet || paypal');
			$table->boolean('payment_method_is_active');
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
		Schema::drop('payment_methods');
	}

}
