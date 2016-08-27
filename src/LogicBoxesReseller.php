<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesReseller extends LogicBoxes {


    private $resellerId = "";
    private $userName = "";
    private $password = "";

	public function __construct($resellerId, $userName = "", $password = "")
    {
        parent::__construct();

        $this->resource = "resellers";
        $this->resellerId = $resellerId;
        $this->userName = $userName;
        $this->password = $password;
    }

    /**
     * Authenticate reseller
     * @return Boolean login status
     */
    public function login()
    {
        $method = 'authenticate';
        $variables = [
            "username" => $this->userName,
            "passwd" => $this->password,
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

    /**
     * Adds a Debit Note against the specified Sub-Reseller's Account.
     * http://manage.netearthone.com/kb/answer/1167
     *         
     * @param [type] $params [description]
     */
    public function availableBalance()
    {
        // Todo: Add debit note method goes here
    }

}