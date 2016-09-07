<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesComodo;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

$orderId = "71784811";
$csr = 'CSR';
$verificationEmail = "test@example.com";

$comodo = new LogicBoxesComodo();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$comodo->setUserId($userId)->setApiKey($apiKey);

$response = $comodo->enroll($orderId, $csr, $verificationEmail)->toArray();

print_r($response);
