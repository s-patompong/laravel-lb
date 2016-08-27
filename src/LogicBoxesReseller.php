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

        $response = $this->get($this->resource, $method, $variables)->toArray();
        if(!isset($response['resellerid'])) return false;
        
        return true;
    }

    /**
     * Adds a Debit Note against the specified Sub-Reseller's Account.
     * http://manage.netearthone.com/kb/answer/1167
     *         
     * @param [type] $params [description]
     */
    public function addDebitNote($variables)
    {
        // Todo: Add debit note method goes here
    }

}