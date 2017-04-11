<?php

namespace LaravelLb;

use LaravelLb\LogicBoxes;

class LogicBoxesContact extends LogicBoxes {

    public $resource;

	public function __construct()
    {
        parent::__construct();

        $this->resource = "contacts";
    }


    /**
     * Getting list of the Contacts using Customer Id .
     * https://manage.netearthone.com/kb/answer/793
     *
     * @param LogicBoxesContact
     */
    public function search($parameters)
    {
      $method = 'search';
      $response = $this->get($this->resource, $method, $parameters);
      return $this;
    }

    /**
     * Getting Details of the Contact using Contact Id .
     * https://manage.netearthone.com/kb/answer/792
     *
     * @param LogicBoxesContact
     */
    public function details($contactId)
    {
        $method = 'details';
        $variables = [
            "contact-id" => $contactId,
        ];

        $response = $this->get($this->resource, $method, $variables);
        return $this;
    }
}
