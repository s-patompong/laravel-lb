<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesCustomer;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

$customerUserName = getenv('CUSTOMER_USERNAME');

$customer = new LogicBoxesCustomer();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$customer->setUserId($userId)->setApiKey($apiKey);


$response = $customer->details('15973450')->toArray();
print_r($response);