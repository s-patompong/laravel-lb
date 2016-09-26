<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesReseller;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

// Setup reseller username and password
$resellerId = getenv('RESELLER_ID');
$resellerUserName = getenv('RESELLER_USERNAME');
$resellerPassword = getenv('RESELLER_PASSWORD');

$reseller = new LogicBoxesReseller($resellerId, $resellerUserName, $resellerPassword);

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$reseller->setUserId($userId)->setApiKey($apiKey);

if($responseResellerId = $reseller->login())
{
	echo "Login success\n";
	echo "Reseller ID :".$responseResellerId;
}
else
{
	echo "Login failed\n";
}
