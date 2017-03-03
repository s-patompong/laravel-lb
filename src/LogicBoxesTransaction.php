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

    /**
     * Resource for greedy transaction
     * @var String
     */
    public $resellerGreedyResource;

    /**
     * No. of record that will be fetched per api call
     * @var Integer
     */
    public $noOfRecord;

    public function __construct($noOfRecord = null)
    {
        parent::__construct();

        $this->baseResource = "billing";

        $this->parentResource = "{$this->baseResource}/my-transactions";

        $this->resellerResource = "{$this->baseResource}/reseller-transactions";

        $this->customerResource = "{$this->baseResource}/customer-transactions";

        $this->resellerArchivedResource = "{$this->baseResource}/reseller-archived-transactions";

        $this->customerArchivedResource = "{$this->baseResource}/customer-archived-transactions";

        $this->noOfRecord = $this->getNoOfRecord($noOfRecord);
    }

    /**
     * Get parent transaction
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getParentTransactions($from, $to)
    {
        return $this->getTransactions($this->parentResource, $from, $to);
    }

    /**
     * Get reseller transaction
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getResellerTransactions($from, $to)
    {
        return $this->getTransactions($this->resellerResource, $from, $to);
    }

    /**
     * Get reseller archived transaction
     * http://manage.netearthone.com/kb/answer/1617
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getResellerArchivedTransactions($from, $to)
    {
        return $this->getTransactions($this->resellerArchivedResource, $from, $to);
    }

    /**
     * Get parent transaction
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getCustomerTransactions($from, $to)
    {
        return $this->getTransactions($this->customerResource, $from, $to);
    }

    /**
     * Get customer archived transaction
     * http://manage.netearthone.com/kb/answer/965
     * @param  Carbon $from From date
     * @param  Carbon $to   To date
     * @return LogicBoxesTransaction
     */
    public function getCustomerArchivedTransactions($from, $to)
    {
        return $this->getTransactions($this->customerArchivedResource, $from, $to);
    }

    /**
     * Get only the transaction from transaction response
     * @param  Array $transactions array of transaction response
     * @return Array
     */
    private function getOnlyTransactionFromResponse($transactions)
    {
        unset($transactions['recsonpage'], $transactions['recsindb']);

        return array_values($transactions);
    }

    /**
     * Get transactions
     * @param  String $resource resource
     * @param  Carbon $from     Get transaction from
     * @param  Carbon $to       Get transaction to
     * @return Array
     */
    private function getTransactions($resource, $from, $to)
    {
        $method = 'search';
        $noOfRecord = $this->noOfRecord;
        $pageNo = 1;

        $variables = [
            'transaction-date-start' => $from->setTime('0', '0', '0')->timestamp,
            'transaction-date-end' => $to->setTime('23', '59', '59')->timestamp,
            'no-of-records' => $noOfRecord,
            'page-no' => $pageNo,
        ];

        $transactions = $this->get($resource, $method, $variables)->toArray();

        $response = [];

        $response = array_merge($response, $this->getOnlyTransactionFromResponse($transactions));

        if($transactions['recsindb'] > $transactions['recsonpage'])
        {
            $pages = ceil($transactions['recsindb'] / $transactions['recsonpage']);

            for($page = 2; $page <= $pages; $page++)
            {
                $variables['page-no'] = $page;

                $transactions = $this->get($resource, $method, $variables)->toArray();

                $response = array_merge($response, $this->getOnlyTransactionFromResponse($transactions));
            }
        }

        return $response;
    }

    /**
     * Get number of record
     * @param  Integer or null $noOfRecord no of record
     * @return Integer
     */
    private function getNoOfRecord($noOfRecord)
    {
        if($noOfRecord)
        {
            return $noOfRecord;
        }

        if(function_exists('config'))
        {
            return config('logicboxes.no_of_record');
        }

        return 100;
    }

    public function getResellerGreedyTransactions($reseller_id)
    {
        $variables = [
            'reseller-id' => $reseller_id,
        ];
        $transactions = $this->get($this->baseResource, 'reseller-greedy-transactions', $variables)->toArray();
        return $transactions;
    }

}
