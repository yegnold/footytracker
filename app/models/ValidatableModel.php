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
    protected $rules = array();

    protected $errors;
    protected $failed_rules;

    public function validate($data = null)
    {

        // If no data is passed in directly, validate the data set against the current instance of the model
        if($data === null) {
            $data = $this->attributesToArray();
        }

        if(!is_array($data)) {
            throw new CantValidateModelDataNotAnArrayException;
        }

        // Reset Errors.
        $this->errors = null;
        $this->failed_rules = null;

        // make a new validator object
        $v = Validator::make($data, $this->rules);

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

class CantValidateModelDataNotAnArrayException extends \Exception { }