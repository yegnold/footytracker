<?php
namespace yegnold\footytracker;

class Team extends \Eloquent
{
	public $table = 'teams';
	protected $softDelete = true;

	// We want to enable Teams to be added to matches quickly with "name" and "score" pre-populated
	// So add this to list of Mass-Assignable fields.
	protected $fillable = array('name', 'score');

	public function players() {
		return $this->belongsToMany('yegnold\footytracker\Player', 'player_appearances');
	}

	public function match() {
		return $this->belongsTo('yegnold\footytracker\Match');
	}
}