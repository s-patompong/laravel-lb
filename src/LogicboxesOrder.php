<?php

namespace LaravelLb;

class LogicboxesOrder extends LogicBoxes
{
    public $resource;

    private $orderId;

    public function __construct($orderId)
    {
        parent::__construct();

        $this->orderId = $orderId;

        $this->resource = "orders";
    }

    public function suspend($reason)
    {
        $method = "suspend";

        $variables = [
            'order-id' => $this->orderId,
            'reason' => $reason,
        ];

        $this->post($this->resource, $method, $variables);

        return $this;
    }

    public function unsuspend()
    {
        $method = "unsuspend";

        $variables = [
            'order-id' => $this->orderId,
        ];

        $this->post($this->resource, $method, $variables);

        return $this;
    }
}
