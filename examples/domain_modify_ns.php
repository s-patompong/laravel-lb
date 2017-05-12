<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesDomain;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$orderId = '5710861';
$nameServers = ['ns1.sedoparking.com', 'ns2.sedoparking.com'];

$domain = new LogicBoxesDomain('');

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$domain->setUserId($userId)->setApiKey($apiKey)->setTestMode(false);

$response = $domain->modifyNs($orderId, $nameServers)->toArray();

print_r($response);
