<?php

use Illuminate\Database\Migrations\Migration;

class CreateMatch extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the players initial database table.
		Schema::create('matches', function($table) {
			$table->increments('id');
			$table->date('match_date');
			$table->mediumText('notes');
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
		// when the end result will be a dropped matches table anyway.
		Schema::drop('matches');
	}

}