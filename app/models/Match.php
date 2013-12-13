<?php
namespace yegnold\footytracker;

class Match extends \Eloquent
{
	public $table = 'matches';
	protected $softDelete = true;

	public function teams() {
		return $this->hasMany('yegnold\footytracker\Team');
	}
}