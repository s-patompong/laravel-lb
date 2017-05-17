<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesDomain extends LogicBoxes
{
    private $domainname = "";

	public function __construct($domainname='')
    {
        parent::__construct();

        $this->resource = "domains";
        $this->domainname = $domainname;

    }

    public function getDomainname()
    {
        return $this->domainname;
    }

    public function setDomainname($domainname)
    {
        $this->domainname = $domainname;
        return $this;
    }



    /**
     * Getting Details of the Domain Registration Order using Domain Name .
     * http://manage.netearthone.com/kb/answer/1755
     *
     * @param LogicBoxesReseller
     */
    public function details()
    {
        $method = 'details-by-name';
        $variables = [
            "domain-name" => $this->domainname,
            "options" => "All"

        ];

        $response = $this->get($this->resource, $method, $variables);
        return $this;
    }

    /**
     * Getting Details of the Domain Registration Order using Order Id .
     * http://manage.netearthone.com/kb/answer/770
     *
     * @param LogicBoxesReseller
     */
    public function detailsByOrderId($orderId)
    {
        $method = 'details';
        $variables = [
            "order-id" => $orderId,
            "options" => "All"
        ];

        $response = $this->get($this->resource, $method, $variables);
        return $this;
    }

    public function search($parameters)
    {
      $method = 'search';
      $response = $this->get($this->resource, $method, $parameters);
      return $this;
    }

    public function modifyNs($orderId, $nameServers)
    {
        $method = 'modify-ns';

        $parameters = [
            'order-id' => $orderId,
        ];

        $this->setAppends(['ns' => $nameServers]);

        $this->post($this->resource, $method, $parameters);

        return $this;
    }

}
