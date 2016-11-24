<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesTransaction;

use Carbon\Carbon;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

$transaction = new LogicBoxesTransaction();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$transaction->setUserId($userId)->setApiKey($apiKey);

$from = Carbon::parse('2016-01-01');
$to = Carbon::parse('2016-05-29');

$response = $transaction->getResellerTransactions($from, $to);
print_r($response);
