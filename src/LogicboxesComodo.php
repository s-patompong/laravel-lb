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
     * Places an SSL Certificate order for the specified Domain Name.
     * @param Array $variables variables
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2396
     */
    public function add($variables)
    {
        $method = "add";
        $this->post($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Gets a list of SSL Certificate orders matching the search criteria, along with the details.
     * @param  Integer $noOfRecord Number of record to search
     * @param  Integer $pageNo     Page number to search
     * @param  Array  $variables  Array of variable
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2401
     */
    public function search($noOfRecord, $pageNo, $variables = [])
    {
        $method = "search";
        $variables = array_merge([
            "no-of-records" => $noOfRecord,
            "page-no" => $pageNo,
        ], $variables);

        $this->get($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Enroll the certificate for the specified order id.
     * @param  String $orderId           Order ID
     * @param  String $csr               CSR
     * @param  String $verificationEmail The verification email
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2397
     */
    public function enroll($orderId, $csr, $verificationEmail)
    {
        $method = "enroll";
        $variables = [
            "order-id" => $orderId,
            "csr" => $csr,
            "verification-email" => $verificationEmail,
        ];

        $this->post($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Gets details of the specified SSL Certificate order
     * Order ID in this place is the entityid that returned when order the cert
     * @param  String $orderId entity id of the cert
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2403
     */
    public function getDetail($orderId)
    {
        $method = "details";
        $variables = [
            "order-id" => $orderId,
        ];

        $this->get($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Reissues an existing SSL Certificate.
     * @param  String $orderId           Order ID
     * @param  String $csr               CSR
     * @param  String $verificationEmail The Verification Email
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2398
     */
    public function reIssue($orderId, $csr, $verificationEmail)
    {
        $method = "reissue";
        $variables = [
            "order-id" => $orderId,
            "csr" => $csr,
            "verification-email" => $verificationEmail,
        ];

        $this->post($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Renews an existing SSL Certificate order.
     * @param  String $orderId           Order ID
     * @param  String $csr               CSR
     * @param  String $verificationEmail The Verification Email
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2399
     */
    public function reNew($orderId, $months, $invoiceOption)
    {
        $method = "renew";
        $variables = [
            "order-id" => $orderId,
            "months" => $months,
            "invoice-option" => $invoiceOption,
        ];

        $this->post($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Deletes the specified SSL Certificate order.
     * @param  String $orderId       Order ID
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2400
     */
    public function delete($orderId)
    {
        $method = "delete";
        $variables = [
            "order-id" => $orderId,
        ];

        $this->post($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Returns the SSL Certificate order id associated with the Domain Name.
     * @param  String $domainName Domain name to search for order id
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2402
     */
    public function getOrderId($domainName)
    {
        $method = "orderid";
        $variables = [
            "domain-name" => $domainName,
        ];

        $this->get($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Changes the verification email
     * @param  String $orderId              Order ID
     * @param  String $newVerificationEmail Verification email to set
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2404
     */
    public function changeVerificationEmail($orderId, $newVerificationEmail)
    {
        $method = "change-verification-email";
        $variables = [
            "order-id" => $orderId,
            "new-verification-email" => $newVerificationEmail,
        ];

        $this->get($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Gets details of the specified SSL Certificate
     * @param  String $orderId Order ID
     * @return LogicboxesComodo
     * http://manage.logicboxes.com/kb/answer/2405
     */
    public function getCertificateDetails($orderId)
    {
        $method = "get-cert-details";
        $variables = [
            "order-id" => $orderId,
        ];

        $this->get($this->resource, $method, $variables);
        return $this;
    }

}