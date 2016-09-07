<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesProduct extends LogicBoxes {

	public $resource;

    public function __construct()
    {
    	$this->resource = "products";
    }

    public function getPlanDetails()
    {
    	$method = "plan-details";
    	$response = $this->get($this->resource, $method);
    	return $this;
    }
    
}