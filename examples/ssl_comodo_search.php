<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesComodo;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

$customerId = getenv('CUSTOMER_ID');
$domainName = getenv('SSL_DOMAIN_NAME');

$noOfRecord = 20;
$pageNo = 1;

$comodo = new LogicBoxesComodo();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$comodo->setUserId($userId)->setApiKey($apiKey);

$response = $comodo->search($noOfRecord, $pageNo)->toArray();

print_r($response);
