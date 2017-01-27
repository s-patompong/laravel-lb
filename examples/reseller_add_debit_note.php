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
$variables = [
	"selling-amount" => 0.15,
	"description" => "Test add debit note",
	"debit-note-date" => time(),
	"transaction-key" => generateRandomString(15),
	"update-total-receipt" => true,
	"conversion-rate" => 1,
	"accounting-amount" => 0.15
];

$reseller = new LogicBoxesReseller($resellerId, $resellerUserName, $resellerPassword);

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$reseller->setUserId($userId)->setApiKey($apiKey);

$response = $reseller->addGreedyDebitNote($variables)->toArray();
print_r($response);
