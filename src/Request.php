<?php

namespace LaravelLb;

Class Request
{
	/**
	 * Interface for out going request
	 * @var String
	 */
	protected $interface;

	/**
	 * Method
	 * @var String
	 */
	protected $method;

	/**
	 * End point
	 * @var String
	 */
	protected $endPoint;

	/**
	 * The result of the request
	 * @var String
	 */
	protected $response;

	public function __construct($endPoint, $method = 'GET', $interface = null)
	{
		$this->interface = $interface;

		$this->method = $method;

		$this->endPoint = $endPoint;
	}

	/**
	 * Set the interface
	 * @param String $interface interface to use to call LB
	 * @return Request
	 */
	public function setInterface($interface)
	{
		$this->interface = $interface;

		return $this;
	}

	/**
	 * Get the interface
	 * @return String interface
	 */
	public function getInterface()
	{
		return $this->getInterface;
	}

	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * Set the method
	 * @param Request
	 */
	public function setMethod($method)
	{
		$this->method = $method;

		return $this;
	}

	/**
	 * Fire the request
	 * @return Request
	 */
	public function get()
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->endPoint);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);

		if($this->interface)
		{
			curl_setopt($ch, CURLOPT_INTERFACE, $this->interface);
		}

		$result = curl_exec($ch);

		curl_close($ch);

		$this->response = $result;

		return $this;
	}

	/**
	 * Cast the result to array
	 * @return Array
	 */
	public function toArray()
	{
		return json_decode($this->response, true);
	}

	/**
	 * Cast the result to json
	 * @return [type] [description]
	 */
	public function toJson()
	{
		return json_decode($this->response);
	}

	/**
	 * Get the response
	 * @return String
	 */
	public function getResponse()
	{
		return $this->response;
	}

}
