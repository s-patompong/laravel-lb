<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesIrtp;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

$irtp = new LogicBoxesIrtp('71848285');

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$irtp->setUserId($userId)->setApiKey($apiKey);

$response = $irtp->details()->toArray();
print_r($response);
