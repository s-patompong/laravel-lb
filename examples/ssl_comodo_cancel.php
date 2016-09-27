<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesComodo;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');
$testMode = getenv('LB_TEST_MODE') == 'true'? true: false;

$orderId = "71946515";

$comodo = new LogicBoxesComodo();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$comodo->setUserId($userId)->setApiKey($apiKey)->setTestMode($testMode);

$response = $comodo->delete($orderId)->toArray();

print_r($response);
