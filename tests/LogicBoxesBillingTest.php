<?php

use PHPUnit\Framework\TestCase;
use LaravelLb\LogicBoxesBilling;

class LogicBoxesBillingTest extends TestCase
{
	public function __construct()
	{
		$this->lb = new LogicBoxesBilling;

		$dotenv = new Dotenv\Dotenv(__DIR__."/../");
		$dotenv->load();
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

	/**
	 * @test
	 */
	public function it_should_get_reseller_balance()
	{
		$method = "reseller-balance";
		$variables = ["reseller-id" => "205918"];

		$lb = new LogicBoxesBilling;
		$response = $lb->get($method, $variables)->toArray();

		$this->assertArrayHasKey('sellingcurrencysymbol', $response);
	}
}