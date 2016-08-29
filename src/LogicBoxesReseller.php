<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesReseller extends LogicBoxes {


    private $resellerId = "";
    private $username = "";
    private $password = "";

	public function __construct($resellerId, $username = "", $password = "")
    {
        parent::__construct();

        $this->resource = "resellers";
        $this->resellerId = $resellerId;
        $this->username = $username;
        $this->password = $password;
    }

    public function getResellerId()
    {
        return $this->resellerId;
    }

    public function setResellerId($resellerId)
    {
        $this->resellerId = $resellerId;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Authenticate reseller
     * @return Boolean
     */
    public function login()
    {
        $method = 'authenticate';
        $variables = [
            "username" => $this->username,
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
     * @param LogicBoxesReseller
     */
    public function addDebitNote($variables)
    {
        $resource = "billing";
        $method = 'add-reseller-debit-note';
        $variables = array_merge([
            "reseller-id" => $this->resellerId,
        ], $variables);

        $response = $this->post($resource, $method, $variables);
        return $this;
    }

    /**
     * Adds a Debit Note against the specified Sub-Reseller's Account.
     * http://manage.netearthone.com/kb/answer/1167
     *
     * @param LogicBoxesReseller
     */
    public function availableBalance()
    {
        $resource = "billing";
        $method = 'reseller-balance';
        $variables = ["reseller-id" => $this->resellerId];

        $response = $this->get($resource, $method, $variables);
        return $this;
    }

    /**
     * Search for reseller transaction
     * @param  Array $variables
     * @return LogicBoxesReseller
     */
    public function searchTransaction($variables)
    {
        $resource = "billing/reseller-transactions";
        $method = 'search';
        $variables = array_merge([
            "reseller-id" => $this->resellerId,
        ], $variables);

        $response = $this->get($resource, $method, $variables);
        return $this;
    }

    /**
     * Adds a Debit Note against the specified Sub-Reseller's Account.
     * http://manage.netearthone.com/kb/answer/1167
     *
     * @param LogicBoxesReseller
     */
    public function addGreedyDebitNote($variables)
    {
        $resource = "billing";
        $method = 'add-reseller-debit-note';
        $variables = array_merge([
            "reseller-id" => $this->resellerId,
            "greedy" => "true",
        ], $variables);

        $response = $this->post($resource, $method, $variables);
        return $this;
    }

}