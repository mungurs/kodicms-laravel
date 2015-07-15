<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notifications extends Migration
{
	public function up()
	{
		Schema::create('notifications', function (Blueprint $table)
		{
			$table->increments('id');

			$table->string('type');
			$table->text('message')->nullable();

			$table->integer('object_id')->unsigned()->nullable();
			$table->string('object_type')->nullable();

			$table->json('settings');

			$table->timestamps();
			$table->timestamp('sent_at');
		});
	}

	public function down()
	{
		Schema::dropIfExists('notifications');
	}
}