<?php 

namespace LaravelLb;

class LogicBoxes {

    private $testMode = false;
    private $userId = "";
    private $apiKey = "";
    private $rootPath = "";
    private $format = "json";

	public function __construct()
    {
        if(function_exists('config'))
        {
            $this->testMode = config('logicboxes.test_mode');
            $this->userId = config('logicboxes.auth_userid');
            $this->apiKey = config('logicboxes.api_key');
            $this->rootPath = $this->generateRootPath($this->testMode);
            $this->credentialString = $this->getCredentialQueryString();
        }   
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId = "")
    {
        $this->userId = $userId;
    }

    public function getApiKey()
    {
        return $this->userId;
    }

    public function setApiKey($apiKey = "")
    {
        $this->apiKey = $apiKey;
    }

    private function getCredentialQueryString()
    {
    	return "auth-userid={$this->userId}&api-key={$this->apiKey}";
    }

    private function generateRootPath($testMode)
    {
    	$path = "https://";
    	if($testMode) $path .= "test.";

    	$path .= "httpapi.com/api";
    	return $path;
    }

    public function setResource($resource)
    {
    	$this->resource = $resource;
    	return $this;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format = "json")
    {
    	$this->format = $format;
    }

    public function setMethod($method)
    {
    	$this->method = $method;
    	return $this;
    }

    public function setVariables($variables)
    {
    	$queryStringArray = [];
    	foreach ($variables as $key => $value) {
    		$queryStringArray[] = "${key}=${value}";
    	}
    	$this->queryString = implode("&", $queryStringArray);
    	return $this;
    }

    public function call()
    {
    	$endPoint = "{$this->rootPath}/{$this->resource}/{$this->method}.{$this->format}?{$this->credentialString}&{$this->queryString}";
    	$this->response = file_get_contents($endPoint);
    	return $this;
    }

    public function getJson()
    {
    	return json_decode($this->response);
    }

    public function getArray()
    {
    	return json_decode($this->response, true);
    }
}
