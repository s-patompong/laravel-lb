<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesReseller;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

// Setup reseller username and password
$resellerId = '117419';

$reseller = new LogicBoxesReseller($resellerId);

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$reseller->setUserId($userId)->setApiKey($apiKey)->setTestMode(false);

$response = $reseller->availableBalance()->toArray();
print_r($response);
