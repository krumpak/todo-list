<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 * php artisan migrate:make create_your_table
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('task_name');
			$table->tinyInteger('status')->default(0);
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
		Schema::drop('tasks');
	}
	//php artisan migrate:reset
}
//php artisan migrate:refresh -> drop&create