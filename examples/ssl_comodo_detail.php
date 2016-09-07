<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesComodo;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

// Order id is the entity id of the cert, you got it when you order the comodo ssl
$orderId = "71784537";

$comodo = new LogicBoxesComodo();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$comodo->setUserId($userId)->setApiKey($apiKey);

$response = $comodo->getDetail($orderId)->toArray();

print_r($response);
