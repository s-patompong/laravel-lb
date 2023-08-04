<?php

namespace LaravelLb;

use LaravelLb\Exceptions\ErrorResponseException;
use LaravelLb\Exceptions\InvalidFormatException;
use LaravelLb\Exceptions\InvalidRequestTypeException;
use LaravelLb\Exceptions\TimeoutResponseException;

class LogicBoxes {

    protected $testMode = true;
    protected $userId = "";
    protected $apiKey = "";
    protected $format = "json";
    protected $variables = [];
    protected $requestType = "GET";
    protected $appends = [];
    protected $request = '';
    protected $throwException = false;

    /**
     * @var Logger
     */
    protected $logger;

    protected $resource;

    protected $method;

    protected $response;

    protected $interface;

    public function __construct()
    {
        $this->interface = null;

        if(function_exists('config')) {
            // Test mode toggle
            $this->testMode = config('logicboxes.test_mode');

            // Credential setup
            $testKey = $this->testMode? 'test': 'live';
            $this->userId = config("logicboxes.credentials.{$testKey}.auth_userid");
            $this->apiKey = config("logicboxes.credentials.{$testKey}.api_key");

            // Interface setup
            $this->interface = config('logicboxes.interface');

            // Whether to throw exception when got error from LB
            $this->throwException = config('logicboxes.throw_exception');
        }

        if(function_exists('app')) {
            $this->logger = app('lb_logger');
        }

        $this->appends = [];
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId = "")
    {
        $this->userId = $userId;
        return $this;
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey = "")
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getTestMode()
    {
        return $this->testMode;
    }

    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;
        return $this;
    }

    public function getRequestType()
    {
        return $this->requestType;
    }

    public function setRequestType($requestType)
    {
        if(!in_array($requestType, ['GET', 'POST']))
        {
            throw new InvalidRequestTypeException("Request type must be only GET or POST", 2);
        }

        $this->requestType = $requestType;
        return $this;
    }

    public function getCredentialQueryString()
    {
    	return "auth-userid={$this->userId}&api-key={$this->apiKey}";
    }

    public function getRootPath()
    {
    	$path = "https://";
    	if($this->testMode) $path .= "test.";

    	$path .= "httpapi.com/api";
    	return $path;
    }

    public function setResource($resource)
    {
    	$this->resource = $resource;
    	return $this;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setFormat($format)
    {
        if(!in_array($format, ['json', 'xml']))
        {
            throw new InvalidFormatException('Logicboxes format can be only json or xml', 1);
        }

        $this->format = $format;
        return $this;
    }

    public function setMethod($method)
    {
    	$this->method = $method;
    	return $this;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setVariables($variables)
    {
        $this->variables = $variables;
        return $this;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function setAppends($appends)
    {
        foreach ($appends as $key => $value) {
            if (!is_array($value))
            {
                $this->appends[] = [$key => $value];
            }
            else
            {
                $this->appends[$key] = $value;
            }
        }

        return $this;
    }

    public function getAppends()
    {
        return $this->appends;
    }

    public function call()
    {
        switch($this->getRequestType())
        {
            case "GET":
                return $this->get($this->resource, $this->method, $this->variables, $this->format);
            case "POST":
                return $this->post($this->resource, $this->method, $this->variables, $this->format);
            default:
                return null;
        }
    }

    public function get($resource, $method, $variables = [], $format = "json")
    {
        $this->requestType = "GET";
        return $this->fire($resource, $method, $variables, $format);
    }

    public function post($resource, $method, $variables = [], $format = "json")
    {
        $this->requestType = "POST";
        return $this->fire($resource, $method, $variables, $format);
    }

    private function fire($resource, $method, $variables = [], $format)
    {
        $this->resource = $resource;
        $this->method = $method;
        $this->variables = $variables;
        $this->format = $format;

        $endPoint = $this->getEndPoint();

        $this->request = $endPoint;

        $client = $this->getClient();

        $this->response = $client->get()->getResponse();

        $this->logger->log($client);

        if ($this->throwException) {
          if (strpos($this->response, '504 Gateway Time-out') !== false) {
            throw new TimeoutResponseException($this->response, 504);
          }

          $response = json_decode($this->response);

          if (isset($response->status)) {
            throw new ErrorResponseException($response->message, 3);
          }
        }

        return $this;
    }

    public function getClient()
    {
        return new Request($this->getEndPoint(), $this->getRequestType(), $this->interface);
    }

    public function setInterface($interface)
    {
        $this->interface = $interface;

        return $this;
    }

    public function getInterface()
    {
        return $this->interface;
    }

    public function getEndPoint()
    {
        $rootPath = $this->getRootPath();
        $credentialString = $this->getCredentialQueryString();
        $queryString = $this->getQueryString();

        return "{$rootPath}/{$this->resource}/{$this->method}.{$this->format}?{$credentialString}&{$queryString}";
    }

    public function getJson()
    {
    	return json_decode($this->response);
    }

    public function toJson()
    {
        return $this->getJson();
    }

    public function getArray()
    {
    	return json_decode($this->response, true);
    }

    public function toArray()
    {
        return $this->getArray();
    }

    public function getQueryString()
    {
        $queryStringArray = [];
        foreach ($this->variables as $key => $value) {
            if ($value === true) {
                $value = 'true';
            } else if ($value === false) {
                $value = 'false';
            }

            $queryStringArray[] = "${key}=${value}";
        }
        if (!empty($this->appends)) {
          foreach ($this->appends as $appendKey => $append) {
              foreach ($append as $key => $value) {
                  if ($value === true) {
                      $value = 'true';
                  } else if ($value === false) {
                      $value = 'false';
                  }

                  $queryStringArray[] = "${appendKey}=${value}";
              }
          }
        }

        return implode("&", $queryStringArray);
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function enabledThrowException()
    {
      $this->throwException = true;
    }

    public function unabledThrowException()
    {
      $this->throwException = false;
    }
    
    /**
     * Encode the variables
     * @param  array $variables 
     * @return array            
     */
    public function encodeVariables($variables)
    {
        foreach ($variables as $key => $value)
        {
            $variables[$key] = urlencode($value);
        }

        return $variables;
    }

    /**
     * Check if the credential is correct and login-able
     */
    public function canLogin()
    {
        $this->get('resellers', 'generate-token', ['ip' => '1.1.1.1']);
        $response = $this->toArray();

        $invalidCredentialMessage = "Invalid credentials, or your User account maybe Inactive or Suspended";

        if(isset($response['message']) && ($response['message'] == $invalidCredentialMessage)) {
            return false;
        }

        return true;
    }

    /**
     * Check if the response is an error
     * @param array|bool $exceptionalMessages The message to be except as an error
     * @param  boolean $stringAble Some method like get reseller API key got a return type as string
     *                                      so we need to allow that to happen
     * @return bool
     */
    public function isErrorResponse($exceptionalMessages = [], $stringAble = true)
    {
        $response = $this->toArray();

        // Return true immediately if the response is null
        if($response == null) return true;

        // Return false if the response is string and we allow stringAble
        if($stringAble && gettype($response) == 'string') return false;

        // If the response doesn't contain status field or it contain but the status field
        // is not ERROR, we don't see it as an error
        if(!isset($response['status']) || ($response['status'] != 'ERROR')) return false;

        // No need to validate if user not set any possible messages
        if(!count($exceptionalMessages)) return true;

        $message = $response['message'] ?? '';

        return !in_array($message, $exceptionalMessages);
    }

    public function setLogger(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function getResponse()
    {
        return $this->response;
    }

}
