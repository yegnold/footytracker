<?php 

// We are testing the \yegnold\footytracker\Player model.
use \yegnold\footytracker\Player;

class PlayerModelTest extends TestCase {
	protected $player;

	public function setUp() {
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
	 * Two users should not be created with the same e-mail address, so verify that we fail if we try to do this.
	 */
	public function testIsInvalidDuplicateEmail() {

	}

	/**
	 * Confirm that setting the password attribute of a Player model
	 * triggers an automated hashing of that attribute
	 * This was shamelessly stolen as an idea from the 'Laravel Testing Decoded' book
	 * by Jeffrey Way.
	 */
	public function testPasswordIsHashed() {
		// Mock the hash object using Mockery.
		Hash::shouldReceive('make')->once()->andReturn('hashed');
		$this->player->password = 'foo';
		$this->assertEquals('hashed', $this->player->password, 'Expected password to be automatically hashed by the player model');
	}



}