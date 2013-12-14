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

// FootyTracker homepage.
Route::get('/', '\yegnold\footytracker\FootyTrackerHomeController@index');


// Management of Players
Route::resource('player', '\yegnold\footytracker\PlayerController');

/**
 * Experiment methods to see if I understood Eloquent correctly
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

