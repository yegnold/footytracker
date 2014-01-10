<?php namespace yegnold\footytracker;

use \Carbon\Carbon;

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
class Match extends ValidatableModel {
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
	 * Validation for Players
	 */
	protected $rules = array(
        'match_date' => 'required|date'
    );

	/**
	 * Block mass-assignment of ID attribute
	 */
    protected $guarded = array(
    	'id', 
    );

    /**
     * Default attribute - empty string for notes, rather than NULL.
     */
    protected $attributes = array(
    	'notes' => ''
    );

	/** 
	 * One match has Many teams. It would be good if we could introduce a limitation to 2 teams here?
	 */
	public function teams() {
		return $this->hasMany('yegnold\footytracker\Team');
	}

	/**
	 * IF we can, we want to convert human-specified fuzzy dates to more DB storage engine friendly date formats
	 * We can do this using Carbon
	 */
	public function setMatchDateAttribute($attribute_value)
	{
		$this->attributes['match_date'] = Carbon::parse($attribute_value)->toDateTimeString();
	}

}