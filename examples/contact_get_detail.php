<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesContact;

$contact = new LogicBoxesContact();

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$contact->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

$response = $contact->details('8548036')->toArray();
print_r($response);
