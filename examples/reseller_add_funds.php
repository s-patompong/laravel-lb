<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesReseller;

// Setup user id and api key
$userId = getenv('LB_TEST_AUTH_USERID');
$apiKey = getenv('LB_TEST_API_KEY');

// Setup reseller username and password
$resellerId = getenv('RESELLER_ID');
$resellerUserName = getenv('RESELLER_USERNAME');
$resellerPassword = getenv('RESELLER_PASSWORD');
$variables = [
	"amount" => 0.15,
	"description" => "Test add debit note",
	"transaction-type" => 'credit',
	"transaction-key" => generateRandomString(15),
	"update-total-receipt" => true
];

$reseller = new LogicBoxesReseller($resellerId, $resellerUserName, $resellerPassword);

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$reseller->setUserId($userId)->setApiKey($apiKey);

$response = $reseller->addFunds($variables)->toJson();
print_r($response);
