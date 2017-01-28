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
            "passwd" => urlencode($this->password),
        ];

        $response = $this->get($this->resource, $method, $variables)->toArray();        
        return isset($response['resellerid']) ? $response['resellerid'] : null;
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

        $variables['description'] = urlencode($variables['description']);

        $response = $this->post($resource, $method, $variables);
        return $this;
    }

    /**
     * Adds a Debit Note against the specified Sub-Reseller's Account.
     * http://manage.netearthone.com/kb/answer/1167
     *
     * @param LogicBoxesReseller
     */
    public function details()
    {
        $method = 'details';
        $variables = [
            "reseller-id" => $this->resellerId
        ];

        $response = $this->get($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Signup reseller
     * @param  Array $variable variable
     * @return LogicBoxesReseller
     */
    public function signup($variables)
    {
        $method = 'signup';

        foreach ($variables as $key => $value)
        {
            $variables[$key] = urlencode($value);    
        }

        $response = $this->post($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Search for Reseller
     * @param  Array $variables   Variables
     * @param  Integer $noOfRecords Number of record per page, must larger than 10
     * @param  Integer $pageNo      Page number
     * @return LogicBoxesReseller              
     * http://manage.netearthone.com/kb/answer/1133
     */
    public function searchReseller($variables, $noOfRecords, $pageNo)
    {
        $method = 'search';

        $variables['no-of-records'] = $noOfRecords;

        $variables['page-no'] = $pageNo;

        $this->get($this->resource, $method, $variables);

        return $this;
    }

    /**
     * Search reseller by email
     * @param  String $email email
     * @return LogicboxesReseller        
     */
    public function searchResellerByEmail($email)
    {
        $variables = [
            'username' => $email,
        ];

        return $this->searchReseller($variables, 10, 1);
    }

}
