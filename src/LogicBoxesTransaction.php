<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesTransaction extends LogicBoxes {

    /**
     * Base resource
     * @var String
     */
    public $baseResource;

    /**
     * Resource for parent transactions
     * @var String
     */
    public $parentResource;

    /**
     * Resource for reseller transactions
     * @var String
     */
    public $resellerResource;

    /**
     * Resource for customer transactions
     * @var String
     */
	public $customerResource;

    public function __construct()
    {
        parent::__construct();

        $this->baseResource = "billing";
        
        $this->parentResource = "{$this->baseResource}/my-transactions";

        $this->resellerResource = "{$this->baseResource}/reseller-transactions";

    	$this->customerResource = "{$this->baseResource}/customer-transactions";
    }

    /**
     * Get parent transaction
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getParentTransactions($from, $to)
    {
    	$method = 'search';
        $noOfRecord = 100;
        $pageNo = 1;

        $variables = [
            'transaction-date-start' => $from->timestamp,
            'transaction-date-end' => $to->setTime('23', '59', '59')->timestamp,
            'no-of-records' => $noOfRecord,
            'page-no' => $pageNo,
        ];

        $response = $this->get($this->parentResource, $method, $variables);

        return $this;
    }

    /**
     * Get parent transaction
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getResellerTransactions($from, $to)
    {
        $method = 'search';
        $noOfRecord = 100;
        $pageNo = 1;

        $variables = [
            'transaction-date-start' => $from->timestamp,
            'transaction-date-end' => $to->setTime('23', '59', '59')->timestamp,
            'no-of-records' => $noOfRecord,
            'page-no' => $pageNo,
        ];

        $response = $this->get($this->resellerResource, $method, $variables);

        return $this;
    }

    /**
     * Get parent transaction
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getCustomerTransactions($from, $to)
    {
        $method = 'search';
        $noOfRecord = 100;
        $pageNo = 1;

        $variables = [
            'transaction-date-start' => $from->timestamp,
            'transaction-date-end' => $to->setTime('23', '59', '59')->timestamp,
            'no-of-records' => $noOfRecord,
            'page-no' => $pageNo,
        ];

        $response = $this->get($this->customerResource, $method, $variables);

        return $this;
    }
    
}
