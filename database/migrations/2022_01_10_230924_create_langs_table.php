<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLangsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('langs')) {
            return;
        }

		Schema::create('langs', function(Blueprint $table)
		{
			$table->integer('lang_id', true);
			$table->string('lang_title', 200);
			$table->string('lang_text', 200);
			$table->string('lang_country_code', 10);
			$table->string('lang_img_obj', 1000);
			$table->boolean('lang_is_rtl');
			$table->boolean('lang_is_active');
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
		Schema::drop('langs');
	}

}
