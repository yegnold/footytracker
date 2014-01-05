<?php 

// We are testing the \yegnold\footytracker\Match model.
use \yegnold\footytracker\Match;
use Way\Tests\Factory;

class MatchModelTest extends TestCase {
	protected $match;

	public function setUp() {
		// As this is a model test, we will probably be running some database-related tests. :)
		$this->setUpDatabase();
		$this->match = new Match;
	}

	public function tearDown() {
		//\Mockery::close();
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
		$this->assertFalse($this->match->validate(array()));
	}

	/**
	 * Check to see that the match date is required.
	 */
	public function testIsInvalidNoMatchDate() {
		$this->assertFalse($this->match->validate(array('match_date' => '')), 'Expected no match date to cause validation failure');
		$this->assertTrue($this->match->errors()->has('match_date'));
		$failures = $this->match->failures();
		$this->assertArrayHasKey('Required', $failures['match_date']);
	}

	/**
	 * Check to see that the match date is verified to be a valid date when given
	 */
	public function testIsInvalidIncorrectlyFormattedMatchDate() {
		$this->assertFalse($this->match->validate(array('match_date' => 'qwerty')), 'Expected invalid match date to cause validation failure');
		$this->assertTrue($this->match->errors()->has('match_date'));
		$failures = $this->match->failures();
		$this->assertArrayHasKey('Date', $failures['match_date']);

		$this->assertFalse($this->match->validate(array('match_date' => '30 February 2014')), 'Expected 30 February date in match_dte to cause validation failure');
		$this->assertTrue($this->match->errors()->has('match_date'));
		$failures = $this->match->failures();
		$this->assertArrayHasKey('Date', $failures['match_date']);
	}

	/**
	 * Check to see that a match is deemed valid with a valid date
	 */
	public function testIsValidWithValidMatchDate() {
		$this->assertTrue($this->match->validate(array('match_date' => '28 February 2014')), 'Expected model to pass validation with a valid match date.');
		$this->assertTrue($this->match->validate(array('match_date' => '2014-02-28')), 'Expected model to pass validation with a valid match date.');
		$this->assertTrue($this->match->validate(array('match_date' => 'February 28th 2014')), 'Expected model to pass validation with a valid match date.');
	}
	
	public function testMatchDateConvertedToCarbonInstance() {
		$this->match->match_date = '2014-02-28';
		$this->assertInstanceOf('\Carbon\Carbon', $this->match->match_date, 'Expected match_date to be mutated to an instance of Carbon.');
	}

	/**
	 * Verify that we are automatically converting the match date to a persistable format
	 */
	public function testMatchDateFormatUpdated() {
		$this->match->match_date = '28 February 2014';
		$this->assertEquals('2014-02-28 00:00:00', $this->match->match_date);
	}
	
}