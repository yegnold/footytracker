<?php 

// We are testing the \yegnold\footytracker\ValidatableModel model.
use \yegnold\footytracker\ValidatableModel;

class ValidatableModelTest extends TestCase {
	protected $validatable_model;

	public function setUp() {
		$this->validatable_model = new ValidatableModel;
	}

	/**
	 * An empty test in case setUp() fails.
	 * This is the most basic test, verifying that Player can be instantiated.
	 */
	public function testInstance() { }

	/**
	 * If ValidatableModel->validate() is called without a parameter,
	 * then it should use it's own data, accessed by
	 * Eloquent->attributesToArray()
	 * ...verify that this works!
	 */
	public function testModelUsesOwnDataIfNoDataPassedToValidateMethod() {
		
		// When we call the model without a parmeter, we want to trigger a call to the attributesToArray() method in the model.
		$model_mock = \Mockery::mock('\yegnold\footytracker\ValidatableModel[attributesToArray]');
		$model_mock->shouldReceive('attributesToArray')->atLeast()->times(1)->andReturn(array('foo' => 'bar'));

		// Try to call it without a parameter.
		$this->assertTrue($model_mock->validate());
	}

	/**
	 * TODO: Test to see if beforeValidate() method is called with the $data parameter
	 */

	/**
	 * Test that if validation passes, we get true back
	 */
	public function testReturnsTrueIfValidationPasses() {

		Validator::shouldReceive('make')->once()->andReturn(
			Mockery::mock(array('passes' => true, 'fails' => false))
		);

		$this->assertTrue($this->validatable_model->validate(array('foo' => 'bar')));
	}

	/**
	 * Test that if validation fails, we get false back
	 */
	public function testReturnsFalseIfValidationFails() {

		Validator::shouldReceive('make')->once()->andReturn(
			Mockery::mock(array('passes' => false, 
								'fails' => true, 
								'errors' => array(), 
								'failed' => array()
						))
		);

		$this->assertFalse($this->validatable_model->validate(array('foo' => 'bar')));
	}

	/**
	 * We should only accept static rules in the format of an array, with string keys and string values
	 */

	/**
	 * This first test checks that we're not allowed to set a static rule with a non-array input
	 * @expectedException \yegnold\footytracker\InvalidStaticRuleException
	 */
	public function testStaticRuleSetFailsWithNonArrayInput() {

		// Clear the Mocks we used in earlier tests
		$this->refreshApplication();

		$set_requirements = 'dave';
		$this->validatable_model->setStaticRules($set_requirements);
	}

	/**
	 * This second test checks that we're not allowed to do this with invalid array formats
	 * it should throw an InvalidStaticRuleException when passed a multidimensional array.
	 * @expectedException \yegnold\footytracker\InvalidStaticRuleException
	 */
	public function testSetStaticRulesFailsWithMultidimensionalArrayInput() {
		$set_requirements = array('multidimensional' => array('multidimensional' => 'array'));
		$this->validatable_model->setStaticRules($set_requirements);
	}

	/**
	 * Check setStaticRules and getStaticRules work properly with valid arguments
	 */
	public function testSetAndGetStaticRules() {
		$set_requirements = array('name' => 'required');
		$this->validatable_model->setStaticRules($set_requirements);
		$this->assertEquals($this->validatable_model->getStaticRules(), $set_requirements, 'Expected getStaticRules() to match input from setStaticRules().');
	}

	/**
	 * Test we can use the replaceStaticRule utility method on a ValidatableModel to swap out validation rules for a field
	 */
	public function testReplaceStaticRule() {
		$set_requirements = array('name' => 'required');
		$this->validatable_model->setStaticRules($set_requirements);
		$this->validatable_model->replaceStaticRule('name', 'min:3');
		$this->assertSame($this->validatable_model->getStaticRules(), array('name' => 'min:3'), 'Expected static rule for name to be changed to min:3');
	}

	/**
	 * We should only accept sometimes rules in the format of a multidimensional array
	 *
	 */

	/**
	 * The first test checks that we reject a basic string input which is invalid.
	 * @expectedException \yegnold\footytracker\InvalidSometimesRuleException
	 */
	public function testSetSometimesRulesFailsWithNonArrayInput() {
		$set_sometimes = 'peter';
		$this->validatable_model->setSometimesRules($set_sometimes);
	}

	/**
	 * The second test checks that we reject a basic array 
	 * not formatted correctly.
	 * @expectedException \yegnold\footytracker\InvalidSometimesRuleException
	 */
	public function testSetSometimesRulesFailsWithIncorrectArrayInput() {
		$set_sometimes = array('1', '2', '3');
		$this->validatable_model->setSometimesRules($set_sometimes);
	}

	/** 
	 * The third test checks that we reject a complex multidimensional array
	 * not matching the expected format.
	 * @expectedException \yegnold\footytracker\InvalidSometimesRuleException
	 */
	public function testSetSometimesRulesFailsWithIncorrectMultidimensionalArrayInput() {
		$set_sometimes = array(array('1', '2', '3'), array('3','4','5'));
		$this->validatable_model->setSometimesRules($set_sometimes);
	}

	/**
	 * Utility method to get valid sometimes rules which are used in multiple tests
	 */
	protected function getValidSometimesRules() {
		return array(
			array('first_name', 'min:4', function($input) {  return $input->name != 'Joe'; } ), 
			array('last_name', 'min:4', function($input) {  return $input->name != 'Smo'; } )
		);

	}

	/**
	 * Check setStaticRules and getStaticRules work properly with valid arguments
	 */
	public function testSetAndGetSometimesRules() {
		$set_sometimes = $this->getValidSometimesRules();

		$this->validatable_model->setSometimesRules($set_sometimes);
		// Using assertSame as this should type-check as well as value-check.
		$this->assertSame($this->validatable_model->getSometimesRules(), $set_sometimes, "Expected output of getSometimesRules to match input to setSometimesRules when input is valid...");
	}

	/**
	 * Verify that addSometimesRule actually adds to the sometimes_rules property of the validatable model
	 */
	public function testAddSometimesRule() {
		// Reset sometimes rules.
		$this->validatable_model->setSometimesRules(array());
		$test_sometimes_rules = $this->getValidSometimesRules();
		// Try to add a single sometimes rule
		$test_add_rule = array_pop($test_sometimes_rules);
		$this->validatable_model->addSometimesRule($test_add_rule);
		$this->assertCount(1, $this->validatable_model->getSometimesRules(), "Expected addSometimesRule to add a single sometimes rule");
		$test_add_rule2 = array_pop($test_sometimes_rules);
		$this->validatable_model->addSometimesRule($test_add_rule2);
		$this->assertCount(2, $this->validatable_model->getSometimesRules(), "Expected addSometimesRule to add a second sometimes rule");
	}

	/**
	 * Check that if we apply some 'sometimes' rules, that they are applied to the validator class.
	 */
	public function testSometimesRuleApplied() {
		$this->validatable_model->setStaticRules(array());
		$this->validatable_model->setSometimesRules($this->getValidSometimesRules());

		// I don't care about the validator's implementation of validation, but I do care
		// that if we've passed in sometimes rules, then they are set on the object.
		$mocked_validator = Mockery::mock();
		$mocked_validator->shouldReceive('sometimes')->atLeast()->times(2);
		$mocked_validator->shouldReceive('fails')->once()->andReturn(false);

		Validator::shouldReceive('make')->once()->andReturn($mocked_validator);
		

		$this->assertTrue($this->validatable_model->validate(array('first_name' => 'Hello', 'last_name' => 'Mate')));

	}
	/**
	 * It would be good to be able to author some tests that check that
	 * the correct values are returned in errors() and failed(), need
	 * to read up on how we can test MessageBag effectively in this instance
	 * as we need to test the response of has()
	 */

}