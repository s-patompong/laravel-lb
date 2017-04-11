<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesContact;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

// Setup user id and api key
$contact = new LogicBoxesContact();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$contact->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

$parameters = [
  'no-of-records' => '100',
  'page-no' => '1',
  'customer-id' => '4676867',
];
$response = $contact->search($parameters)->toJson();
print_r($response);
