<?php 

namespace LaravelLb;

class LogicBoxes {

	public function __construct($auth_userid, $api_key, $testMode = true)
    {
        $this->userId = $auth_userid;
        $this->apiKey = $api_key;
        $this->rootPath = $this->generateRootPath($testMode);
        $this->setFormat("json");

        $this->credentialString = $this->getCredentialQueryString();
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
