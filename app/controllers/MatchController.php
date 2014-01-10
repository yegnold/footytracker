<?php namespace yegnold\footytracker;

use BaseController;
use View;
use Redirect;
use Input;
use Hash;
use \Carbon\Carbon as Carbon;

class MatchController extends BaseController {

	/**
	 * Display a listing of matches.
	 * We'll display two things.
	 * 
	 * 1. Upcoming matches/meetups
	 * 2. Past matches/meetup.
	 *
	 * @return Response
	 */
	public function getIndex()
	{

		// Pull out upcoming Matches. No limit here.
		$upcoming_matches = Match::where('match_date', '>=', Carbon::now()->toDateTimeString())->orderBy('match_date')->get();

		// Pull out previous Matches. Say 10 at first
		$previous_matches = Match::where('match_date', '<', Carbon::now()->toDateTimeString())->orderBy('match_date DESC')->take(10)->get();
		
		return View::make('match.index')->with('upcoming_matches', $upcoming_matches)->with('previous_matches', $previous_matches);
	}

	/**
	 * Display a form to create a new match/meetup
	 */
	public function getCreate() {
		return View::make('match.create');
	}

	/**
	 * Process form submissions for creating a new match/meetup
	 *
	 * @return Response
	 */
	public function postCreate() {

		$post_data = Input::all();

		$match = new Match;

		// Create a new match instance as we are trying to create one!
		if($match->validate($post_data)) {
			$match->match_date = Input::get('match_date');
			$match->save();
			return Redirect::to('match/index')->with('message', 'The meetup was created');
		} else {
			// Chuck 'em back to the form with our errors.
			return Redirect::back()->withErrors($match->errors())->withInput(Input::all());
		}
	}
}