<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesReseller extends LogicBoxes {

	public function __construct()
    {
        parent::__construct();
        $this->resource = "resellers";
    }

    // TODO: Think of another way to overide the method, PHP doesn't accept override the function
    public function get($method, $variables, $format = "json")
    {
    	return parent::get($this->resource, $method, $variables, $format);
    }

}