<?php

use Illuminate\Database\Seeder;
use App\Post;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		factory(App\User::class, 100)->create();
		$user1 = new App\User();
		$user1->email = "randi@codeup.com";
		$user1->name = "Randi";
		$user1->password = Hash::make('codeup');
		$user1->save();

		$user2 = new App\User();
		$user2->email = "test@codeup.com";
		$user2->name = "Test";
		$user2->password = Hash::make('test');
		$user2->save();
	}
}