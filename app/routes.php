<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * FootyTracker routing preference
 * I prefer to leave "how do I handle GET versus POST" to Controllers
 * So I've adopted the 'RESTful' method of defining controllers which means
 * that the controller definitions are getMethod, postMethod, etc
 * See http://laravel.com/docs/controllers#restful-controllers
 * This means we primarily use the Route::controller() method.
 */

/**
 * I want to enable CSRF protection on all POST, PUT and DELETE requests
 */
Route::when('*', 'csrf', array('post', 'put', 'delete'));


/**
 * I used "php artisan auth:reminders-controller" to generate the Reminders controller
 */
Route::controller('password', 'RemindersController');

/**
 * I'm using a Route Group to require authentication to access the routes below
 * As you can tell, the bulk of the application is authentication-protected.
 */
Route::group(array(/*'before' => 'auth'*/), function() {

	/**
	 * FootyTracker homepage/dashboard
	 */
	Route::get('/', '\yegnold\footytracker\FootyTrackerHomeController@index');

	/** 
	 * Management of Players
	 */
	Route::controller('player', '\yegnold\footytracker\PlayerController');


	/**
	 * Experiment methods to see if I understood Eloquent correctly
	 * I'm leaving these in for now as a demonstration of my understanding of Eloquent.
	 */

	// Do I get how to add an eloquent row?:
	Route::get('/testaddplayer', function()
	{
		$player = new yegnold\footytracker\Player;
		$player->first_name = 'Ed';
		$player->last_name = 'Yarnold';
		$player->email = 'yegnold@gmail.com';
		$player->password = '';
		$player->mobile = '07837428224';
		$player->save();
	});

	// Let's experiment with populating player, player_appearance, team and match all in one go:
	Route::get('/testaddmatch', function()
	{
		$match = new yegnold\footytracker\Match;
		$match->match_date = '2013-12-11';
		$match->notes = 'Some Note';
		$match->save();

		$home_team = new yegnold\footytracker\Team(array('name' => 'Blues', 'score' => 9));
		$match->teams()->save($home_team);

		$new_player = new yegnold\footytracker\Player;
		$new_player->first_name = 'Ed';
		$new_player->last_name = 'Yarnold';
		$new_player->email = 'yegnold@gmail.com';
		$new_player->password = '';
		$new_player->mobile = '07837428224';
		$new_player->save();

		// Attach added player to the home team.
		$home_team->players()->attach($new_player);
		$away_team = new yegnold\footytracker\Team(array('name' => 'Whites', 'score' => 7));
		$match->teams()->save($away_team);
	});
// End of Auth-required group.
});

