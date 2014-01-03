<?php namespace yegnold\footytracker;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Hash;
/**
 * A 'Player' is someone that participates in the football group being tracked by footytracker.
 * They have a 'volatile' relationship with Teams, i.e. they can be affiliated with a different
 * team every week.
 *
 * I've made this model work in the same way as the default Laravel 'User' model
 * i.e. it implements UserInterface and RemindableInterface.
 * This is because this model will be used for accessing the app.
 */
class Player extends ValidatableModel implements UserInterface, RemindableInterface {

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
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Validation for Players
	 */
	protected $rules = array(
        'first_name' => 'required|min:2|max:25',
        'last_name' => 'required|min:2|max:25',
        'email' => 'required|email|unique:players,email',
        'password' => 'required|min:6|confirmed',
    );

    protected function beforeValidate(&$data) {
    	/**
    	 * If we're an existing player the requirement on password becomes 'optional' ('sometimes')
    	 */
    	if(array_key_exists('id', $data) && strlen($data['id'])) {
    		unset($this->rules['password']);

    		// We still want to validate the password but only if one's supplied (i.e. the user attempts to reset their password)
    		$sometimes_rules = $this->getSometimesRules();
    		$new_sometimes_rule = array(
    			'password',
    			'required|min:6|confirmed',
    			function($input) { return (bool)strlen($input->password); }
			);
    		array_push($sometimes_rules, $new_sometimes_rule);
    		$this->setSometimesRules($sometimes_rules);
    	}
    }

	/**
	 * One player can appear in many teams (across different weeks)
	 * Note. This system currently has no way of representing the situation where a player
	 *  'swaps sides' mid-way through a game.
	 */
	public function appearances() {
		return $this->belongsToMany('yegnold\footytracker\Team', 'player_appearances');
	}

	/**
	 * Get the unique identifier for the user/player.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user/player.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * We want our model to handle the hashing of the password
	 */
	public function setPasswordAttribute($password) {
		if(strlen($password)) {
			$this->attributes['password'] = Hash::make($password);
		} else {
			$this->attributes['password'] = $password;
		}
	}
}