<?php
use \yegnold\footytracker\Player as Player;

/**
 * For variables available in every page in the admin area
 */
View::composer(array('layouts.master'), function($view)
{
	/**
	 * I want a count of the total number of players in the system
	 */
    $view->with('players_count', Player::count());
});