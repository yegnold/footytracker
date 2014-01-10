<?php

use Way\Tests\Factory;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PlayerTableSeeder');
	}

}

class PlayerTableSeeder extends Seeder {

	public function run()
	{
		// Delete all existing players.
		DB::table('players')->delete();

		// Create three example players
		// We will use player1@ player2@ and player3@ footyracker.example.org as e-mail addresses.
		// Because we're using soft delete, we want to make sure the factory doesnt automatically add these as deleted models.
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Barry', 'last_name' => 'Y', 'email' => 'player1@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Rich', 'last_name' => 'N', 'email' => 'player2@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Russ', 'last_name' => 'X', 'email' => 'player3@footytracker.example.org', 'deleted_at' => null));

		// Create an example player we can log in as...
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Edward', 'last_name' => 'Yarnold', 'email' => 'yegnold@gmail.com', 'password' => Hash::make('access'), 'deleted_at' => null));

		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Will', 'last_name' => 'Y', 'email' => 'player4@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Chris', 'last_name' => 'S', 'email' => 'player5@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Big', 'last_name' => 'Tim', 'email' => 'player6@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Little', 'last_name' => 'Tim', 'email' => 'player7@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Policeman', 'last_name' => 'Dave', 'email' => 'player8@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Hairy', 'last_name' => 'Dave', 'email' => 'player9@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Alfie', 'last_name' => 'N', 'email' => 'player10@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Matt', 'last_name' => 'W', 'email' => 'player11@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Andy', 'last_name' => 'W', 'email' => 'player12@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Little', 'last_name' => 'Will', 'email' => 'player13@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Other', 'last_name' => 'Chris', 'email' => 'player14@footytracker.example.org', 'deleted_at' => null));

	}

}