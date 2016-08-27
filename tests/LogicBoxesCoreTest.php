<?php

use PHPUnit\Framework\TestCase;
use LaravelLb\LogicBoxes;
use LaravelLb\Exceptions\InvalidFormatException;
use LaravelLb\Exceptions\InvalidRequestTypeException;

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

    /**
     * @test
     */
    public function it_should_be_able_to_set_test_mode()
    {
        $testMode = false;

        $lb = new LogicBoxes;
        $lb->setTestMode($testMode);
        
        $this->assertEquals($lb->getTestMode(), $testMode);
    }

    /**
     * @test
     */
    public function it_should_generate_correct_root_path_when_test_mode_is_false()
    {
        $testMode = false;
        $rootPath = "https://httpapi.com/api";

        $lb = new LogicBoxes;
        $lb->setTestMode($testMode);
        
        $this->assertEquals($lb->getRootPath(), $rootPath);
    }

    /**
     * @test
     */
    public function it_should_generate_correct_root_path_when_test_mode_is_true()
    {
        $testMode = true;
        $rootPath = "https://test.httpapi.com/api";

        $lb = new LogicBoxes;
        
        $this->assertEquals($lb->getRootPath(), $rootPath);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_set_method()
    {
        $method = "search";

        $this->lb->setMethod($method);
        
        $this->assertEquals($this->lb->getMethod(), $method);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_set_resource()
    {
        $resource = "resellers";

        $this->lb->setResource($resource);
        
        $this->assertEquals($this->lb->getResource(), $resource);
    }

    /**
     * @test
     */
    public function it_should_has_correct_end_point()
    {
        $testMode = false;
        $userId = "432256";
        $apiKey = "SgVhO5SxAwEtF";
        $resource = "billing";
        $method = "reseller-balance";
        $format = "xml";
        $variables = [
            "reseller-id" => "123456",
        ];

        $expectedEndpoint = "https://httpapi.com/api/billing/reseller-balance.xml?auth-userid=432256&api-key=SgVhO5SxAwEtF&reseller-id=123456";

        $lb = new LogicBoxes;
        $actualEndpoint = $lb->setTestMode($testMode)
                             ->setUserId($userId)
                             ->setApiKey($apiKey)
                             ->setResource($resource)
                             ->setMethod($method)
                             ->setFormat($format)
                             ->setVariables($variables)
                             ->getEndPoint();
        
        $this->assertEquals($actualEndpoint, $expectedEndpoint);
    }

    /**
     * @test
     */
    public function it_should_have_default_request_type_as_get()
    {
        $requestType = "GET";

        $lb = new LogicBoxes;
        
        $this->assertEquals($lb->getRequestType(), $requestType);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_set_request_type()
    {
        $requestType = "POST";

        $this->lb->setRequestType($requestType);
        
        $this->assertEquals($this->lb->getRequestType(), $requestType);
    }

    /**
     * @test
     */
    public function it_should_be_able_to_throw_invalid_request_type()
    {
        $requestType = "PUT";

        $this->expectException(InvalidRequestTypeException::class);

        $this->lb->setRequestType($requestType);
    }

}
?>