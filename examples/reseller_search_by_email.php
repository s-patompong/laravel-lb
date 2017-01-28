<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesReseller;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

// Setup reseller username and password
$reseller = new LogicBoxesReseller('');

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$reseller->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

$response = $reseller->searchResellerByEmail('test_neo_7@example.com')->toArray();

print_r($response);
