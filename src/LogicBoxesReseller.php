<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesReseller extends LogicBoxes {

	public function __construct()
    {
        parent::__construct();
        $this->resource = "resellers";
    }

    public function get($method, $variables, $format = "json")
    {
    	return parent::get($this->resource, $method, $variables, $format);
    }

}