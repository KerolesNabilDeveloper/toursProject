<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePushTokensTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('push_tokens')) {
            return;
        }

		Schema::create('push_tokens', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->text('push_token');
			$table->string('UDID');
			$table->string('ip_address', 20);
			$table->string('country', 20)->comment('from IP');
			$table->string('device_type', 20)->index()->comment('android or ios');
			$table->string('device_name')->comment('samsung galaxy note 8 or iphone x or ...');
			$table->string('os_version')->comment('ios 11 or android 9');
			$table->string('app_version', 20)->comment('1.0.0');
			$table->dateTime('last_login_date')->nullable();
			$table->boolean('send_push')->default(1);
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
		Schema::drop('push_tokens');
	}

}
