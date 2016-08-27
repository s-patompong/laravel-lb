<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesReseller extends LogicBoxes {

	public function __construct()
    {
        parent::__construct();
        $this->resource = "resellers";
    }

    /**
     * Authenticate reseller
     * @return Boolean login status
     */
    public function login($username, $password)
    {
        $method = 'authenticate';
        $variables = [
            "username" => $username,
            "passwd" => $password,
        ];

        $this->get($this->resource, $method, $variables);
        return $this;
    }

}