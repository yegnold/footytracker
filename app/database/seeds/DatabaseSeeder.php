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
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Abc', 'last_name' => 'Jkl', 'email' => 'player1@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Def', 'last_name' => 'Mno', 'email' => 'player2@footytracker.example.org', 'deleted_at' => null));
		Factory::create('\yegnold\footytracker\Player', array('first_name' => 'Ghi', 'last_name' => 'Pqr', 'email' => 'player3@footytracker.example.org', 'deleted_at' => null));
	}

}