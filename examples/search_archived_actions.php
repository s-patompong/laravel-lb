<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesActions;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$lb = new LogicBoxesActions;

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$lb->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

$response = $lb->searchArchivedActions()->toArray();

print_r($response);
