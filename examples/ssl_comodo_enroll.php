<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesComodo;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$orderId = "75202576";
$csr = 'CSR';
$verificationEmail = "admin@ssldemosite.com";

$comodo = new LogicBoxesComodo();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$comodo->setUserId($userId)->setApiKey($apiKey)->setTestMode(false);

$response = $comodo->enroll($orderId, $csr, $verificationEmail)->toArray();

print_r($response);
