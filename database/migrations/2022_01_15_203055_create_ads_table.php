<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('ads')) {
            return;
        }

		Schema::create('ads', function(Blueprint $table)
		{
			$table->integer('ads_id', true);
			$table->integer('user_id');
			$table->text('ads_cat_ids');
			$table->integer('ads_city_id');
			$table->string('ads_status', 100);
			$table->text('ads_title');
			$table->text('ads_description');
			$table->text('ads_img_obj');
			$table->text('ads_slider');
			$table->string('ads_phone', 100);
			$table->string('ads_whatsapp_phone', 100);
			$table->boolean('is_active_by_user');
			$table->boolean('disabled_by_system');
			$table->dateTime('ads_publish_date')->nullable();
			$table->dateTime('ads_end_at')->nullable();
			$table->integer('ads_total_reports');
			$table->integer('ads_total_views');
			$table->date('ads_production_date')->nullable();
			$table->boolean('ads_disallow_comment');
			$table->boolean('ads_has_system_insurance');
			$table->decimal('ads_price', 12)->comment('في حاله الضمان من السيستيم');
			$table->dateTime('ads_modification_date')->comment('تاريخ تحديث الاعلان لعرضه في التطبيق');
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
		Schema::drop('ads');
	}

}
