<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('categories')) {
            return;
        }

		Schema::create('categories', function(Blueprint $table)
		{
			$table->integer('cat_id', true);
			$table->integer('parent_id')->default(0);
			$table->string('cat_type', 30);
			$table->text('cat_name');
			$table->string('cat_img_obj', 300);
			$table->integer('cat_order');
			$table->boolean('is_active');
			$table->text('cat_meta_title');
			$table->text('cat_meta_desc');
			$table->text('cat_meta_keywords');
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
		Schema::drop('categories');
	}

}
