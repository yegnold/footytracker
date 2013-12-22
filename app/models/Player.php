<?php
namespace yegnold\footytracker;

/**
 * A 'Player' is someone that participates in the football group being tracked by footytracker.
 * They have a 'volatile' relationship with Teams, i.e. they can be affiliated with a different
 * team every week.
 */
class Player extends \Eloquent
{

	/**
	 * This would work out of the box with the auto-guessing of table names
	 * but I prefer to be explicit.
	 */
	public $table = 'players';

	/**
	 * Because players might stop participating, but we want to maintain a record of
	 * how they did, we want to use 'soft deletion'. This means that rather than records
	 * being deleted, they're flagged as "deleted" using deleted_timestamp.
	 */
	protected $softDelete = true;

	/**
	 * One player can appear in many teams (across different weeks)
	 * Note. This system currently has no way of representing the situation where a player
	 *  'swaps sides' mid-way through a game.
	 */
	public function appearances() {
		return $this->belongsToMany('yegnold\footytracker\Team', 'player_appearances');
	}
}