<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

	    if (Schema::hasTable('users')) {
            return;
        }

		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('user_id');
			$table->string('user_enc_id', 200);
			$table->integer('membership_id');
			$table->date('membership_registered_at')->nullable();
			$table->date('membership_end_at')->nullable();
			$table->string('api_id', 300);
			$table->string('provider', 300);
			$table->string('logo_img_obj', 300);
			$table->string('username', 100)->unique('username');
			$table->string('email')->unique('email');
			$table->string('temp_email', 300);
			$table->string('first_name', 300);
			$table->string('last_name', 300);
			$table->string('full_name', 300);
			$table->string('user_gender', 10);
			$table->decimal('user_wallet', 12);
			$table->string('user_type', 200)->index('user_type');
			$table->string('user_role', 100)->comment('عضويه فعاله او تحت الرقابة او مقيده او موقوفه');
			$table->string('password');
			$table->dateTime('password_changed_at')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->boolean('user_is_blocked')->default(0);
			$table->string('user_country_code', 10)->comment('ex. EG');
			$table->string('user_city', 300);
			$table->string('phone_code', 10);
			$table->string('phone', 300);
			$table->string('temp_phone', 300);
			$table->string('user_address', 300);
			$table->string('verification_code', 50);
			$table->dateTime('verification_code_expiration')->nullable();
			$table->string('password_reset_code', 50);
			$table->dateTime('password_reset_expire_at')->nullable();
			$table->boolean('is_active');
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
		Schema::drop('users');
	}

}
