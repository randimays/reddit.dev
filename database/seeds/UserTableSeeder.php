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
		if (App::environment('local')) {
			factory(App\User::class, 10)->create();
			$user1 = new App\User();
			$user1->email = "randi@codeup.com";
			$user1->name = "Randi";
			$user1->password = Hash::make('codeup');
			$user1->save();
		}
	}
}