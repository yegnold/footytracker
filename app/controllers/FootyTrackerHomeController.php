<?php namespace yegnold\footytracker;

use View;
use BaseController;

class FootyTrackerHomeController extends BaseController {

	public function index()
	{
		return View::make('home');
	}

}