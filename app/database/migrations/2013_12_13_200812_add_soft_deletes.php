<?php

use Illuminate\Database\Migrations\Migration;

class AddSoftDeletes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('players', function($table) {
			$table->softDeletes();
		});
		Schema::table('matches', function($table) {
			$table->softDeletes();
		});
		Schema::table('teams', function($table) {
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('players', function($table) {
			$table->dropColumn('deleted_at');
		});
		Schema::table('matches', function($table) {
			$table->dropColumn('deleted_at');
		});
		Schema::table('teams', function($table) {
			$table->dropColumn('deleted_at');
		});
	}

}