<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxes;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

$customerUserName = getenv('CUSTOMER_USERNAME');

$lb = new LogicBoxes();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$lb->setUserId($userId)->setApiKey($apiKey);


$response = $lb->get('customers', 'details', [
	"username" => $customerUserName,
])->toArray();
print_r($response);