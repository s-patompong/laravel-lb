<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesComodo;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$customerId = "158722";
$domainName = "ssldemosite.com";
$months = 12;

$comodo = new LogicBoxesComodo();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$comodo->setUserId($userId)->setApiKey($apiKey);

$response = $comodo->add([
	"domain-name" => $domainName,
	"months" => $months,
	"customer-id" => $customerId,
	"plan-id" => LogicBoxesComodo::POSITIVE_SSL,
	"invoice-option" => LogicBoxesComodo::NO_INVOICE,
])->toArray();

print_r($response);
