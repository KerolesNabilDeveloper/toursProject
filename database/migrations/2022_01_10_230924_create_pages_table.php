<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('pages')) {
            return;
        }

		Schema::create('pages', function(Blueprint $table)
		{
			$table->increments('page_id');
			$table->integer('article_cat_id')->nullable();
			$table->string('page_img_obj', 500);
			$table->string('page_title', 1000);
			$table->text('page_body');
			$table->string('page_type')->index()->comment('default or article');
			$table->boolean('hide_page');
			$table->integer('page_order');
			$table->integer('page_visited_count');
			$table->boolean('show_page_on_footer_menu');
			$table->boolean('show_page_on_header_menu');
			$table->boolean('page_is_featured')->comment('displayed on homepage if true');
			$table->text('page_meta_title');
			$table->text('page_meta_desc');
			$table->text('page_meta_keywords');
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
		Schema::drop('pages');
	}

}
