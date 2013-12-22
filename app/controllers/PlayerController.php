<?php
namespace yegnold\footytracker;

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
		// Create a new player instance as we are trying to create one!
		$player = new Player;
		if($player->validate($post_data)) {
			$player->first_name = Input::get('first_name');
			$player->last_name = Input::get('last_name');
			$player->email = Input::get('email');
			$player->password = Hash::make(Input::get('password'));
			$player->mobile = Input::get('mobile');
			$player->save();
			return Redirect::to('player/index')->with('message', 'The player was created');
		} else {
			// Chuck 'em back to the form with our errors.
			return Redirect::back()->withErrors($player->errors())->withInput(Input::except(array('password', 'password_confirmation')));
		}
	}


}