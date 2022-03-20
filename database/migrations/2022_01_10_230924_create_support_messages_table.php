<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('support_messages')) {
            return;
        }

		Schema::create('support_messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index()->comment('if he logged in');
			$table->string('msg_type', 20)->index()->comment('support or bug');
			$table->string('full_name');
			$table->string('phone')->comment('with code');
			$table->string('email');
			$table->text('message');
			$table->boolean('is_seen');
			$table->string('ip_address', 20);
			$table->string('country', 20);
			$table->string('timezone', 20);
			$table->string('UDID');
			$table->string('device_type', 20)->comment('samsung or iphone or oppo or ...');
			$table->string('device_name')->comment('samsung galaxy note 8 or iphone x or ...');
			$table->string('os_version', 20)->comment('ios 11 or andriod ');
			$table->string('app_version', 20)->comment('1.0.0');
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
		Schema::drop('support_messages');
	}

}
