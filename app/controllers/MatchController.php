<?php namespace yegnold\footytracker;

use BaseController;
use View;
use Redirect;
use Input;
use Hash;

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
		$upcoming_matches = Match::where('match_date', '>=', 'NOW()')->orderBy('match_date')->get();
		
		return View::make('match.index')->with('upcoming_matches', $upcoming_matches);
	}
}