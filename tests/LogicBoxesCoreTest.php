<?php

use PHPUnit\Framework\TestCase;
use LaravelLb\LogicBoxes;
use LaravelLb\InvalidFormatException;

class LogicBoxesCoreTest extends TestCase
{

	public function __construct()
	{
		$this->lb = new LogicBoxes;
	}

	/**
     * @test
     */
    public function it_should_be_able_to_set_user_id()
    {
    	$userId = 'myUserId';

    	$this->lb->setUserId($userId);

        $this->assertEquals($this->lb->getUserId(), $userId);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_set_api_key()
    {
    	$apiKey = 'myApiKey';

    	$this->lb->setApiKey($apiKey);

        $this->assertEquals($this->lb->getApiKey(), $apiKey);
    }

    /**
     * @test
     */
    public function it_should_has_json_as_a_default_format()
    {
    	$format = 'json';

    	$lb = new LogicBoxes;

        $this->assertEquals($lb->getFormat(), $format);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_set_format_to_xml()
    {
    	$format = 'xml';
    	
    	$this->lb->setFormat($format);

        $this->assertEquals($this->lb->getFormat(), $format);
    }

    /**
     * @test
     */
    public function it_should_throw_invalid_format_exception()
    {
    	$format = 'html';
    	
    	$this->expectException(InvalidFormatException::class);
    	$this->lb->setFormat($format);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_set_variables()
    {
    	$variables = [
    		"variable_a" => "A_Variable",
    		"variable_b" => "B_Variable",
    	];

    	$this->lb->setVariables($variables);
    	
    	$this->assertEquals($this->lb->getVariables(), $variables);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_set_variables_and_get_query_string()
    {
    	$variables = [
    		"variable_a" => "A_Variable",
    		"variable_b" => "B_Variable",
    	];
    	$queryString = "variable_a=A_Variable&variable_b=B_Variable";

    	$this->lb->setVariables($variables);
    	
    	$this->assertEquals($this->lb->getQueryString(), $queryString);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_get_login_query_string()
    {
    	$userId = "myUserId";
    	$apiKey = "myApiKey";
    	$credentialQueryString = "auth-userid=${userId}&api-key=${apiKey}";

    	$this->lb->setUserId($userId)->setApiKey($apiKey);
    	
    	$this->assertEquals($this->lb->getCredentialQueryString(), $credentialQueryString);
    }
}
?>