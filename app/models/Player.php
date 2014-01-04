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

	/**
	 * Block mass-assignment of ID and password attributes
	 */
    protected $guarded = array(
    	'id', 
    	'password'
    );

    /**
     * This method manipulates the validation rules against the model for existing users, whose password
     * should only be validated by the model if it ws provided. - i.e. the requirement only exists if we've
     * tried to update the password.
     */
    protected function updatePasswordValidationForExistingPlayer() {
    	unset($this->rules['password']);

		// We still want to validate the password but only if one's supplied (i.e. the user attempts to reset their password)
		$password_sometimes_rule = array(
			'password',
			'required|min:6|confirmed',
			function($input) { return (bool)strlen($input->password); }
		);
		$this->addSometimesRule($password_sometimes_rule);
    }

    /**
     * This method manipulates the unique e-mail validation for an existing player, to allow the current palyer to retain their own email
     */
    protected function updateUniqueEmailValidationForExistingPlayer() {
    	$this->replaceStaticRule('email', 'required|email|unique:players,email,'.(int)$this->id);
    }

    protected function beforeValidate(&$data) {
    	/**
    	 * If we're an existing player 
    	 * 1) The requirement on password becomes 'optional' ('sometimes')
    	 * 2) The 'unique' rule for email needs to ignore the current record ID.
    	 */
    	if(isset($this->id) || (array_key_exists('id', $data) && strlen($data['id']))) {
    		$this->updatePasswordValidationForExistingPlayer();
    		$this->updateUniqueEmailValidationForExistingPlayer();
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
	 * This method should be used instead of $player_instance->password = 'xyz';
	 */
	public function newPassword($password) {
		if(strlen($password)) {
			$this->password = Hash::make($password);
		} else {
			$this->password = $password;
		}
	}
}