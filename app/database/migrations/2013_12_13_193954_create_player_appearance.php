<?php

use Illuminate\Database\Migrations\Migration;

class CreatePlayerAppearance extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the players initial database table.
		Schema::create('player_appearances', function($table) {
			$table->increments('id');
			$table->integer('player_id')->index();
			$table->integer('team_id')->index();
			$table->integer('goals');
			$table->decimal('paid_amount', 5, 2);
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
		// when the end result will be a dropped player_appearances table anyway.
		Schema::drop('player_appearances');
	}

}