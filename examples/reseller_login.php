<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesReseller;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

// Setup reseller username and password
$resellerId = '681572';
$resellerUserName = 'test_neo_4@example.com';
$resellerPassword = 'wF7dd.j9H&W5x4&';

$reseller = new LogicBoxesReseller($resellerId, $resellerUserName, $resellerPassword);

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$reseller->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

if($responseResellerId = $reseller->login())
{
	echo "Login success\n";
	echo "Reseller ID :".$responseResellerId;
}
else
{
	echo "Login failed\n";
}
