<?php
namespace yegnold\footytracker;

class Player extends \Eloquent
{
	public $table = 'players';
	protected $softDelete = true;

	public function appearances() {
		return $this->belongsToMany('yegnold\footytracker\Team', 'player_appearances');
	}
}