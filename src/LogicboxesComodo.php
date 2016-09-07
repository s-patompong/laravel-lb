<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesComodo extends LogicBoxes {

    public $resource;
    const POSITIVE_SSL_WILDCARD = 301;
    const POSITIVE_SSL = 300;
    const COMODO_SSL = 299;

    const NO_INVOICE = "NoInvoice";
    const PAY_INVOICE = "PayInvoice";
    const KEEP_INVOICE = "KeepInvoice";
    const ONLY_ADD = "OnlyAdd";

    public function __construct()
    {
        parent::__construct();

        $this->resource = "sslcert";
    }

    /**
     * Add the ssl
     * @param Array $variables Variables to send to LB API
     * http://manage.logicboxes.com/kb/answer/2396
     */
    public function add($variables)
    {
        $method = "add";
        $this->post($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Search ssl order according to the criteria
     * @param  Array $variables Search criteria
     * http://manage.logicboxes.com/kb/answer/2401
     */
    public function search($noOfRecord, $pageNo, $variables = [])
    {
        $method = "search";
        $variables = array_merge([
            "no-of-records" => $noOfRecord,
            "page-no" => $pageNo,
        ], $variables);

        $this->post($this->resource, $method, $variables);
        return $this;
    }

}