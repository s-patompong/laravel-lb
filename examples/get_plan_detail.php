<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesProduct;

// Setup user id and api key
$userId = getenv('LB_AUTH_USERID');
$apiKey = getenv('LB_API_KEY');

$product = new LogicBoxesProduct();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$product->setUserId($userId)->setApiKey($apiKey);

$response = $product->getPlanDetails()->toArray();
print_r($response);