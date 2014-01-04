<?php namespace yegnold\footytracker;

use BaseController;
use View;
use Redirect;
use Input;
use Hash;

class PlayerController extends BaseController {

	protected $player;

	public function __construct(Player $player)
	{
		$this->player = $player;
	}

	/**
	 * Display a listing of players.
	 * Order them alphabetically by first name.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$players = $this->player->orderBy('first_name')->get();
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
		
		if($this->player->validate($post_data)) {
			$this->player->first_name = Input::get('first_name');
			$this->player->last_name = Input::get('last_name');
			$this->player->email = Input::get('email');
			// Passwords expected to be hashed should be set using my newPassword method on the player model...
			$this->player->newPassword(Input::get('password'));
			$this->player->mobile = Input::get('mobile');
			$this->player->save();
			return Redirect::to('player/index')->with('message', 'The player was created');
		} else {
			// Chuck 'em back to the form with our errors.
			return Redirect::back()->withErrors($this->player->errors())->withInput(Input::except(array('password', 'password_confirmation')));
		}
	}


}