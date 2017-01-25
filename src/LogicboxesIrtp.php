<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesIrtp extends LogicBoxes {

    public $resource;

    public $orderId;

    public function __construct($orderId)
    {
        parent::__construct();

        $this->orderId = $orderId;

        $this->resource = "domains/irtp/verification";
    }

    /**
     * Get IRTP Authorization status for an action which is waiting for IRTP Authorization
     * @param Array $variables variables
     * @return LogicBoxesIrtp
     * http://manage.logicboxes.com/kb/answer/2804
     */
    public function details()
    {
        $method = "details";

        $this->get($this->resource, $method, $this->getOrderIdArray());

        return $this;
    }

    /**
     * Resend the Authorization email to all participants in the IRTP task.
     * @param Array $variables variables
     * @return LogicBoxesIrtp
     * http://manage.logicboxes.com/kb/answer/2803
     */
    public function resend()
    {
        $method = "resend";

        $this->post($this->resource, $method, $this->getOrderIdArray());

        return $this;
    }

    /**
     * Cancels ongoing IRTP process linked to the order.
     * @param Array $variables variables
     * @return LogicBoxesIrtp
     * http://manage.logicboxes.com/kb/answer/2802
     */
    public function cancel($reason)
    {
        $method = "cancel";

        $variables = $this->getOrderIdArray();

        $variables['reason'] = $reason;

        $this->post($this->resource, $method, $variables);

        return $this;
    }

    /**
     * Get order id array
     * @return Array
     */
    private function getOrderIdArray()
    {
        return [ 'order-id' => $this->orderId ];
    }

}
