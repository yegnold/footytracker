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
	 * Confirm that setting the password attribute of a Player model
	 * triggers an automated hashing of that attribute
	 * This was shamelessly stolen as an idea from the 'Laravel Testing Decoded' book
	 * by Jeffrey Way.
	 */
	public function testPasswordIsHashed() {
		// Mock the hash object using Mockery.
		Hash::shouldReceive('make')->once()->andReturn('hashed');
		$this->player->password = 'foo';
		$this->assertEquals('hashed', $this->player->password);
	}

}