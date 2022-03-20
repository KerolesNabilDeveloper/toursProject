<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('chats')) {
            return;
        }

		Schema::create('chats', function(Blueprint $table)
		{
			$table->integer('chat_id', true);
			$table->string('chat_enc_id', 250);
			$table->string('chat_name', 250);
			$table->string('chat_type', 50)->comment('personal || for-auction || for-deal || support');
			$table->integer('chat_type_id')->nullable()->comment('auction_id or deal_id');
			$table->string('chat_member_ids', 250);
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
		Schema::drop('chats');
	}

}
