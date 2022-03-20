<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

        if (Schema::hasTable('chat_members')) {
            return;
        }

		Schema::create('chat_members', function(Blueprint $table)
		{
			$table->integer('cm_id', true);
			$table->integer('chat_id')->index('chat_id');
			$table->integer('member_id')->index('member_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('chat_members');
	}

}
