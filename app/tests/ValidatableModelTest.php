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
	 * It would be good to be able to author some tests that check that
	 * the correct values are returned in errors() and failed(), need
	 * to read up on how we can test MessageBag effectively in this instance
	 * as we need to test the response of has()
	 */

}