<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 * 
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		/* insert users*/

		DB::table('users')->truncate(); //clean before insert
		$db_insert_users=array(
			array(
				'name' => 'Demo User',
				'username' => 'demo',
				'email' => 'demo@demo.com',
				'password' => Hash::make('demo'),
				'reset_password' => '0b13aeff1961493e83fd54368045527afdc4a79d61314629ece54661a3dbaa77',
				'confirmed' => true,
				'created_at' => new DateTime
			),
			array(
				'name' => 'Guest',
				'username' => 'guest',
				'email' => 'guest@guest.com',
				'password' => Hash::make('guest'),
				'reset_password' => '16435aaef60f961b47537d435cc7d33a995661d21f941uabaeed41f738246ue8',
				'confirmed' => true,
				'created_at' => new DateTime
			)
		);

		DB::table('users')->insert( $db_insert_users );

		/* insert tasks*/

		DB::table('tasks')->truncate(); //clean before insert
		$db_insert_tasks=array(
			array(
				'user_id' => '1',
				'task_name' => 'Buy a milk',
				'status' => '0',
				'created_at' => new DateTime
			),
			array(
				'user_id' => '1',
				'task_name' => 'Feed the dog',
				'status' => '1',
				'created_at' => new DateTime
			),
			array(
				'user_id' => '1',
				'task_name' => 'Wash the car',
				'status' => '0',
				'created_at' => new DateTime
			),
			array(
				'user_id' => '2',
				'task_name' => 'Buy a book',
				'status' => '0',
				'created_at' => new DateTime
			),
			array(
				'user_id' => '2',
				'task_name' => 'Feed the cat',
				'status' => '1',
				'created_at' => new DateTime
			),
			array(
				'user_id' => '2',
				'task_name' => 'Take the trash',
				'status' => '1',
				'created_at' => new DateTime
			)
		);
		DB::table('tasks')->insert( $db_insert_tasks );
	}

}
//php artisan db:seed