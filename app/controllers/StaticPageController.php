<?php namespace yegnold\footytracker;

use View;
use BaseController;

class StaticPageController extends BaseController {

	public function about()
	{
		return View::make('static.about');
	}

}