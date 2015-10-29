<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 * php artisan migrate:make create_your_table
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password');
			$table->string('reset_password');
			$table->boolean('confirmed')->default(false);
			$table->rememberToken();
			$table->timestamps();
		});
	}
	 //php artisan migrate
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}
	//php artisan migrate:reset
}
//php artisan migrate:refresh -> drop&create