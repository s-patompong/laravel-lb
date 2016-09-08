<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesCustomer extends LogicBoxes {

    const STATE_NOT_APPLICABLE = "Not Applicable";

	public $resource;

    public function __construct()
    {
        parent::__construct();
        
    	$this->resource = "customers";
    }

    /**
     * Sign up the new customer
     * @return LogicBoxesCustomer
     * http://manage.logicboxes.com/kb/answer/804
     */
    public function signUp($variables)
    {
    	$method = "signup";
    	$this->post($this->resource, $method, $variables);
    	return $this;
    }
    
}