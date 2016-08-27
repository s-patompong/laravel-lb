<?php

require __DIR__.'/../vendor/autoload.php';

use LaravelLb\LogicBoxesReseller;

$lb = new LogicBoxesReseller;

// Setup user id and api key
$userId = '';
$apiKey = '';

// Setup reseller username and password
$resellerUserName = '';
$resellerPassword = '';

$lb->setUserId($userId)->setApiKey($apiKey);

$response = $lb->login($resellerUserName, $resellerPassword)->toArray();
print_r($response);