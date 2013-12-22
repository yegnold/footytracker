<?php
namespace yegnold\footytracker;

/**
 * A Match represents a 'meet'.
 * A match in football terms is 1 team versus another
 * 
 * I am not sure if hasMany() is the right relationship here: it might've been
 * more accurate to have a hasOne home team and hasOne away team, but because
 * there is actually no such thing as home/away in the football I'm tracking, I 
 * stuck with one hasMany relationship as this makes it easier to report on things
 * such as 'most consecutive appearances'
 */
class Match extends ValidatableModel
{
	/**
	 * This would work out of the box with the auto-guessing of table names
	 * but I prefer to be explicit.
	 */
	public $table = 'matches';

	/**
	 * Use softDelete
	 */
	protected $softDelete = true;

	/** 
	 * One match has Many teams. It would be good if we could introduce a limitation to 2 teams here?
	 */
	public function teams() {
		return $this->hasMany('yegnold\footytracker\Team');
	}
}