<?php namespace yegnold\footytracker;

 /**
  * For the purposes of the footytracker app, 'teams' are match-specific.
  * They don't work like 'teams' in a football league, teams last for one match only.
  */
class Team extends ValidatableModel {
	/**
	 * This would work out of the box with the auto-guessing of table names
	 * but I prefer to be explicit.
	 */
	public $table = 'teams';

	/**
	 * Use softDelete so we have a record of historic data for teams.
	 */
	protected $softDelete = true;

	/**
	 * We want to enable Teams to be added to matches quickly with "name" and "score" pre-populated
	 * So add this to list of Mass-Assignable fields.
	 */
	protected $fillable = array('name', 'score');

	/**
	 * One team can have many players
	 * (the number of players can vary dependent on the number of match participants)
	 */
	public function players() {
		return $this->belongsToMany('yegnold\footytracker\Player', 'player_appearances');
	}

	/**
	 * Because teams are match specific they have a relationship where they "belong to" a match
	 * rather than "participate in" a match, as might be expected in a traditional football app.
	 */
	public function match() {
		return $this->belongsTo('yegnold\footytracker\Match');
	}
}