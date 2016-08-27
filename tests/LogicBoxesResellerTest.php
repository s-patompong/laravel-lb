<?php

use PHPUnit\Framework\TestCase;
use LaravelLb\LogicBoxesReseller;

class LogicBoxesResellerTest extends TestCase
{
	public function __construct()
	{
		$this->lb = new LogicBoxesReseller;

		$dotenv = new Dotenv\Dotenv(__DIR__."/../");
		$dotenv->load();
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

}