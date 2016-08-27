<?php

use PHPUnit\Framework\TestCase;
use LaravelLb\LogicBoxesReseller;

class LogicBoxesResellerTest extends TestCase
{
	public function __construct()
	{
		$this->lb = new LogicBoxesReseller;
	}

	/**
	 * @test
	 */
	public function it_should_automatically_add_resrouce()
	{
		$resource = "resellers";

		$lb = new LogicBoxesReseller;

		$this->assertEquals($lb->getResource(), $resource);
	}

	/**
	 * @test
	 */
	public function it_should_be_able_to_set_username()
	{
		$username = "resellerUsername";

		$this->lb->setUsername($username);

		$this->assertEquals($this->lb->getUsername(), $username);
	}

	/**
	 * @test
	 */
	public function it_should_be_able_to_set_reseller_id()
	{
		$resellerId = "resellerId";

		$this->lb->setResellerId($resellerId);

		$this->assertEquals($this->lb->getResellerId(), $resellerId);
	}

	/**
	 * @test
	 */
	public function it_should_be_able_to_set_password()
	{
		$password = "password";

		$this->lb->setPassword($password);

		$this->assertEquals($this->lb->getPassword(), $password);
	}

}