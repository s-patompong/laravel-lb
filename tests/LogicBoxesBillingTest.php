<?php

use PHPUnit\Framework\TestCase;
use LaravelLb\LogicBoxesBilling;

class LogicBoxesBillingTest extends TestCase
{
	public function __construct()
	{
		$this->lb = new LogicBoxesBilling;
	}

	/**
	 * @test
	 */
	public function it_should_automatically_add_resrouce()
	{
		$resource = "billing";

		$lb = new LogicBoxesBilling;

		$this->assertEquals($lb->getResource(), $resource);
	}

}