<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('countries')) {
            return;
        }

		Schema::create('countries', function(Blueprint $table)
		{
			$table->integer('country_id', true);
			$table->string('country_code', 3);
			$table->string('country_mobile_code', 5);
			$table->string('country_mobile_start_with', 50)->comment('056,56,010,10');
			$table->integer('country_mobile_length');
			$table->text('country_name');
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
		Schema::drop('countries');
	}

}
