<?php

use Illuminate\Database\Migrations\Migration;

class CreatePlayer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the players initial database table.
		Schema::create('players', function($table) {
			$table->increments('id');
			$table->string('first_name', 128);
			$table->string('last_name', 128);
			$table->string('email', 255);
			$table->string('password', 60);
			$table->string('mobile', 20);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// As per Dayle's CodeBright book, no point doing the opposite directly
		// when the end result will be a dropped players table anyway.
		Schema::drop('players');
	}

}