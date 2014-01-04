<?php namespace yegnold\footytracker;

use BaseController;
use View;
use Redirect;
use Input;
use Hash;

class PlayerController extends BaseController {

	/**
	 * Display a listing of players.
	 * Order them alphabetically by first name.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$players = Player::orderBy('first_name')->get();
		return View::make('player.index', compact('players'));
	}

	/**
	 * Show the form for creating a new player.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('player.create');
	}

	/**
	 * Process form submissions for creating a new player
	 *
	 * @return Response
	 */
	public function postCreate() {

		$post_data = Input::all();

		$player = new Player;

		// Create a new player instance as we are trying to create one!
		if($player->validate($post_data)) {
			$player->first_name = Input::get('first_name');
			$player->last_name = Input::get('last_name');
			$player->email = Input::get('email');
			// Passwords expected to be hashed should be set using my newPassword method on the player model...
			$player->newPassword(Input::get('password'));
			$player->mobile = Input::get('mobile');
			$player->save();
			return Redirect::to('player/index')->with('message', 'The player was created');
		} else {
			// Chuck 'em back to the form with our errors.
			return Redirect::back()->withErrors($player->errors())->withInput(Input::except(array('password', 'password_confirmation')));
		}
	}

	/**
	 * Show the form for modifying an existing player
	 * @return Response
	 */
	public function getEdit($id) {

		$modify_player = Player::findOrFail($id);

		$prefill_data = $modify_player->toArray();

		return View::make('player.edit')->with('player', $modify_player)->with('prefill_data', $prefill_data);
	}

	/**
	 * Handle the updating of an existing player
	 */
	public function postEdit($id) {

		$post_data = Input::all();
		// If we validate with an ID then the model validation knows to alter validation logic.
		$post_data['id'] = $id;

		$modify_player = Player::findOrFail($id);
		
		if($modify_player->validate($post_data)) {
			$modify_player->first_name = Input::get('first_name');
			$modify_player->last_name = Input::get('last_name');
			$modify_player->email = Input::get('email');
			if(strlen(Input::get('password'))) {
				// Passwords expected to be hashed should be set using my newPassword method on the player model...
				$modify_player->newPassword(Input::get('password'));
			}
			$modify_player->mobile = Input::get('mobile');
			$modify_player->save();
			return Redirect::to('player/index')->with('message', 'The player was updated');
		} else {
			// Chuck 'em back to the form with our errors.
			return Redirect::back()->withErrors($modify_player->errors())->withInput(Input::except(array('password', 'password_confirmation')));
		}

	}
}