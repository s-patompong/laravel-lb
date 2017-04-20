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

        $variables = $this->encodeVariables($variables);

    	$this->post($this->resource, $method, $variables);
        
    	return $this;
    }

    /**
     * Sign up the new customer
     * @return LogicBoxesCustomer
     * http://manage.netearthone.com/kb/answer/967
     */
    public function details($customerId)
    {
        $method = "details-by-id";
        $this->get($this->resource, $method, [
            'customer-id' => $customerId
        ]);
        return $this;
    }

    public function detailsByUsername($username)
    {
        $method = "details";
        $this->get($this->resource, $method, [
            'username' => $username
        ]);
        return $this;
    }
}
