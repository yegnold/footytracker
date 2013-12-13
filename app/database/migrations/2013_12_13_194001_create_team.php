<?php

use Illuminate\Database\Migrations\Migration;

class CreateTeam extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the players initial database table.
		Schema::create('teams', function($table) {
			$table->increments('id');
			$table->integer('name');
			$table->integer('match_id')->index();
			$table->integer('score');
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
		// when the end result will be a dropped teams table anyway.
		Schema::drop('teams');
	}

}