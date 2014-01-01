<?php 

// We are testing the \yegnold\footytracker\Player model.
use \yegnold\footytracker\Player;
use Way\Tests\Factory;

class PlayerModelTest extends TestCase {
	protected $player;

	public function setUp() {
		// As this is a model test, we will probably be running some database-related tests. :)
		$this->setUpDatabase();
		$this->player = new Player;
	}

	/**
	 * An empty test in case setUp() fails.
	 * This is the most basic test, verifying that Player can be instantiated.
	 */
	public function testInstance() { }

	/**
	 * If someone passes no data to the validate() model,
	 * we should fail validation
	 */
	public function testIsInvalidEmptyPost() {
		$this->assertFalse($this->player->validate(array()));
	}

	/**
	 * Check to see that the first name is required.
	 */
	public function testIsInvalidNoFirstName() {
		$this->assertFalse($this->player->validate(array('first_name' => '')), 'Expected no first name to cause validation failure');
		$this->assertTrue($this->player->errors()->has('first_name'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Required', $failures['first_name']);
	}

	/**
	 * Check to see that the first name length restriction is in effect
	 * do this by passing in a single-letter long first name
	 */
	public function testIsInvalidShortFirstName() {
		$this->assertFalse($this->player->validate(array('first_name' => 'A')), 'Expected short first name to cause validation failure');
		$this->assertTrue($this->player->errors()->has('first_name'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Min', $failures['first_name']);
	}

	/**
	 * Check to see that the first name restriction of 25 characters is in effect
	 */
	public function testIsInvalidLongFirstName() {
		$this->assertFalse($this->player->validate(array('first_name' => 'abcdefghijklmnopqrstuvwxyz')), 'Expected long first name to cause validation failure');
		$this->assertTrue($this->player->errors()->has('first_name'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Max', $failures['first_name']);
	}

	/**
	 * Check to see that the last name is required.
	 */
	public function testIsInvalidNoLastName() {
		$this->assertFalse($this->player->validate(array('last_name' => '')), 'Expected no last name to cause validation failure');
		$this->assertTrue($this->player->errors()->has('last_name'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Required', $failures['last_name']);
	}

	
	/**
	 * Check to see that the last name length restriction is in effect
	 * do this by passing in a single-letter long last name
	 */
	public function testIsInvalidShortLastName() {
		$this->assertFalse($this->player->validate(array('last_name' => 'A')), 'Expected short last name to cause validation failure');
		$failures = $this->player->failures();
		$this->assertTrue($this->player->errors()->has('last_name'));

		$this->assertArrayHasKey('Min', $failures['last_name']);
	}

	/**
	 * Check to see that the last name restriction of 25 characters is in effect
	 */
	public function testIsInvalidLongLastName() {
		$this->assertFalse($this->player->validate(array('last_name' => 'abcdefghijklmnopqrstuvwxyz')), 'Expected long last name to cause validation failure');
		$this->assertTrue($this->player->errors()->has('last_name'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Max', $failures['last_name']);
	}

	/**
	 * Check to see that e-mail is required
	 */
	public function testIsInvalidNoEmail() {
		$this->assertFalse($this->player->validate(array('email' => '')), 'Expected no email to cause validation failure');
		$this->assertTrue($this->player->errors()->has('email'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Required', $failures['email']);
	}

	/**
	 * Check to see that e-mail is validated as a valid email address
	 */
	public function testIsInvalidWithInvalidEmail() {
		$this->assertFalse($this->player->validate(array('email' => 'assadsa')), 'Expected invalid email to cause validation failure');
		$this->assertTrue($this->player->errors()->has('email'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Email', $failures['email']);
	}

	/**
	 * Check to see that the password requirement is in effect
	 */
	public function testIsInvalidNoPassword() {
		$this->assertFalse($this->player->validate(array('password' => '')), 'Expected no password to cause validation failure');
		$this->assertTrue($this->player->errors()->has('password'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Required', $failures['password']);
	}

	/**
	 * Check to see that a password minimum length is in effect
	 */
	public function testIsInvalidShortPassword() {
		$this->assertFalse($this->player->validate(array('password' => 'abc1')), 'Expected short password to cause validation failure');
		$this->assertTrue($this->player->errors()->has('password'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Min', $failures['password']);
	}

	/**
	 * Check to see that the passwords are verified as matching
	 */
	public function testIsInvalidMismatchPassword() {
		$this->assertFalse($this->player->validate(array('password' => 'abc123456', 'password_confirmation' => 'abcasssss6')), 'Expected mismatched password to cause validation failure');
		$this->assertTrue($this->player->errors()->has('password'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Confirmed', $failures['password']);
	}

	/**
	 * Confirm that setting the password attribute of a Player model to a non-empty value
	 * triggers an automated hashing of that attribute
	 * This was shamelessly stolen as an idea from the 'Laravel Testing Decoded' book
	 * by Jeffrey Way.
	 */
	public function testPopulatedPasswordIsHashed() {
		// Mock the hash object using Mockery.
		Hash::shouldReceive('make')->once()->andReturn('hashed');
		$this->player->password = 'foo';
		$this->assertEquals('hashed', $this->player->password, 'Expected password to be automatically hashed by the player model');
	}

	/**
	 * If the password is set to an empty string we don't want to
	 * hash the empty string
	 */
	public function testEmptyPasswordRemainsEmpty() {
		$this->player->password = '';
		$this->assertEquals('', $this->player->password, 'Empty password expected to be left as the empty string');
	}



	/**
	 * An existing user providing no new password shouldn't need to provide or confirm password etc
	 */
	public function testIsValidExistingUserNoPassword() {
		// Make a generated player with an ID and empty password field
		$generated_player = Factory::make('\yegnold\footytracker\Player', array('id' => 22, 'password' => ''));
		$this->assertTrue($generated_player->validate(), 'Expected existing player not providing a new password to validate.');
	}

	/**
	 * .. but an existing user providing a password should need to confirm it
	 */
	public function testIsInvalidExistingUserResetPasswordNoConfirmation() {
		// Make a generated player with an ID and filled password field, but no confirm password field
		$generated_player_attributes = Factory::attributesFor('\yegnold\footytracker\Player', array('id' => 22, 'password' => 'abc123'));
		$this->assertFalse($this->player->validate($generated_player_attributes), 'Expected existing player resetting password to fail validation');
		$this->assertTrue($this->player->errors()->has('password'));
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Confirmed', $failures['password']);
	}

	/**
	 * Two users should not be created with the same e-mail address, so verify that we fail if we try to do this.
	 */
	public function testIsInvalidDuplicateEmail() {
		// Our database seeds create a player player1@footytracker.example.org
		// So creating another one of these should fail.
		$generated_player_attributes = Factory::attributesFor('\yegnold\footytracker\Player', array('email' => 'player1@footytracker.example.org'));
		$this->assertFalse($this->player->validate($generated_player_attributes), 'Expected player to fail validation due to duplicate email');
		$this->assertTrue($this->player->errors()->has('email'), 'Expected player to fail validation due to duplicate email: email error doesnt exist');
		$failures = $this->player->failures();
		$this->assertArrayHasKey('Unique', $failures['email'], 'Expected player to fail validation due to duplicate email: Unique failure not present.');
	}

	/**
	 * An existing user should be able to change their e-mail address to their own
	 */
	public function testIsValidWithOwnEmail() {
		// We already created player1@footytracker.example.org in our database seeding...
		$loaded_player = \yegnold\footytracker\Player::whereEmail('player1@footytracker.example.org')->firstOrFail();
		$loaded_player->password = '';
		$this->assertTrue($loaded_player->validate(), 'Expected player loaded from database to pass validation');
	}

	

}