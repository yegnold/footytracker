<?php namespace yegnold\footytracker;

use Validator;

/**
 * Because we are going to use validation on a lot of models,
 * we should define common validation functionality e.g. validate(), errors(),
 * in one place
 *
 * This code is taken from Dayle Rees' tutorial:
 * http://daylerees.com/trick-validation-within-models
 * He calls his model Elegant, I call mine ValidtableModel. I'm exciting!
 * 
 */
class ValidatableModel extends \Eloquent {
    
    /**
     * Static rules that don't change
     * @var array 
     */
    protected $rules = array();

    /**
     * 'Sometimes' rules for use in conjunction with Validator->sometimes
     * Should be in the format array(
     *  array('field', 'validation_rules', function($input) { return $input->test > 0; } )
     * )
     *
     * @var array
     */
    protected $sometimes_rules = array();

    protected $errors;
    protected $failed_rules;

    /**
     * This method can be used to get the static validation rules for the model.
     * @return array
     */
    public function getStaticRules() 
    { 
        return $this->rules; 
    }

    /**
     * This method can be used to change the static validation rules on the model, post-instantiation.
     * @param array $rules - Single dimensional array of rules, the same as expected by Validator::make()
     */
    public function setStaticRules($rules) 
    { 
        /**
         * Validate format of static rules passed in
         */
        
        // $rules should be an array.
        if(!is_array($rules)) {
            throw new InvalidStaticRuleException('setStaticRules expects an array in parameter $rules');
        }

        // $rules should be an array consisting solely of 'string' keys and 'string' values.
        $hit_invalid_item = false;
        foreach($rules as $k => $v) {
            if(!is_string($k) || !is_string($v)) {
                $hit_invalid_item = true;
                break;
            }
        }
        if($hit_invalid_item) { 
            throw new InvalidStaticRuleException('setStaticRules expects a single dimensional array with string keys and string values.');
        }

        $this->rules = $rules; 
    }

    /**
     * This method can be used to get the 'sometimes' rules on the model
     * @return array
     */
    public function getSometimesRules() 
    { 
        return $this->sometimes_rules; 
    }

    /**
     * This method can be used to change the 'sometimes' validation rules on the model
     * @param array $rules - Multi-dimensional array (top level a list of second level, 3-item arrays: 
     *   key 0: field name, key 1: validation rules, key 2: closure to check input)
     *
     * Example, imagine having a minimum rule for 'name' of 4 characters except for "jon":
     * $this->setSometimesRules(array(array('name', 'min:4', function($input) { return ($input->name != 'Jon'); }))));
     *
     */
    public function setSometimesRules($rules)
    { 
       /**
         * Validate format of sometimes rules passed in
         */
        
        // $rules should be an array.
        if(!is_array($rules)) {
            throw new InvalidSometimesRuleException('setSometimesRules expects an array in parameter $rules');
        }

        // $rules should be an array consisting of other arrays, each 3-items long with [0] a string, [1] a string and [2] a Closure.
        $hit_invalid_item = false;
        foreach($rules as $k => $v) {
            // I'm using is_callable below, but would prefer $v[2] instanceof Closure = behaviour of instanceof Closure "should not be depended on" in PHP 5.3.
            if(!is_array($v) || count($v) != 3 || !is_string($v[0]) || !is_string($v[1]) || !is_callable($v[2])) {
                $hit_invalid_item = true;
                break;
            }
        }
        if($hit_invalid_item) { 
            throw new InvalidSometimesRuleException('setSometimesRules expects a multidimensonal array with a list of 3-key long arrays within, those arrays containing field name, validation rules and a closure..');
        }

        $this->sometimes_rules = $rules; 
    }

    /**
     * This method is called before the validation of the data is applied in $this->validate()
     * This can be extended by other models to dynamically alter validation rules dependent on input.
     */
    protected function beforeValidate(&$data) { }

    public function validate($data = null)
    {

        // If no data is passed in directly, validate the data set against the current instance of the model
        if($data === null) {
            $data = $this->attributesToArray();
        }

        if(!is_array($data)) {
            throw new CantValidateModelDataNotAnArrayException;
        }

        // Trigger the beforeValidate callback.
        $this->beforeValidate($data);

        // Reset Errors.
        $this->errors = null;
        $this->failed_rules = null;

        // make a new validator object
        $v = Validator::make($data, $this->rules);
        // Me experimenting with mocks: var_dump($v instanceof \Mockery\MockInterface);
        // Add any sometimes rules.
        foreach($this->sometimes_rules as $sometimes_rule) {
            $v->sometimes($sometimes_rule[0], $sometimes_rule[1], $sometimes_rule[2]);
        }

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            $this->failed_rules = $v->failed();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
    public function failures() {
        return $this->failed_rules;
    }
}

// Thrown when we try to setStaticRules() with an incorrectly formatted array.
class InvalidStaticRuleException extends \Exception { }
// Thrown when we try to setSometimesRules() with an incorrectly formatted array.
class InvalidSometimesRuleException extends \Exception { }
class CantValidateModelDataNotAnArrayException extends \Exception { }