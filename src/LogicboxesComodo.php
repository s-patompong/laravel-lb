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

    public function add($variables)
    {
        $method = "add";
        $this->post($this->resource, $method, $variables);
        return $this;
    }

}