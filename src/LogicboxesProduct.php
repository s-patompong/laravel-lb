<?php

namespace LaravelLb;

class LogicBoxesProduct extends LogicBoxes {

	public $resource;

    public function __construct()
    {
        parent::__construct();
        
    	$this->resource = "products";
    }

    public function getPlanDetails()
    {
    	$method = "plan-details";
    	$response = $this->get($this->resource, $method);
    	return $this;
    }

    /**
     * Move domain to another customer
     * Ref: https://manage.netearthone.com/kb/answer/904
     *
     * @param $domainName
     * @param $customerIdFrom
     * @param $customerIdTo
     * @return LogicBoxes
     */
    public function move($domainName, $customerIdFrom, $customerIdTo)
    {
        $variables = [
            'domain-name' => $domainName,
            'existing-customer-id' => $customerIdFrom,
            'new-customer-id' => $customerIdTo,
        ];
        $method = 'move';

        return $this->post($this->resource, $method, $variables);
    }
    
}