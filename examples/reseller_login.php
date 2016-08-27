<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesReseller;

$lb = new LogicBoxesReseller;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

// Setup reseller username and password
$resellerUserName = getenv('RESELLER_USERNAME');
$resellerPassword = getenv('RESELLER_PASSWORD');

$lb->setUserId($userId)->setApiKey($apiKey);

$response = $lb->login($resellerUserName, $resellerPassword);

if($response)
{
	echo "Login success\n";
}
else
{
	echo "Login failed\n";
}