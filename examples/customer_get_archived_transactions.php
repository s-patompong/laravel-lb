<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesTransaction;
use Carbon\Carbon;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$lb = new LogicBoxesTransaction();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$lb->setUserId($userId)->setApiKey($apiKey)->setTestMode(false);

$from = Carbon::create(2016, 10, 1);
$to = Carbon::create(2016, 10, 2);

$response = $lb->getCustomerArchivedTransactions($from, $to);
print_r($response);
