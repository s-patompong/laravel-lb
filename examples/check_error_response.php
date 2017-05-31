<?php

require __DIR__.'/autoload.php';

$contact = new LaravelLb\LogicboxesContact;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$contact->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

// Test with exceptional messages
$isError = $contact->details('8548036')->isErrorResponse(['Invalid credentials, or your User account maybe Inactive or Suspended']);
if($isError) {
    echo "Error\n";
} else {
    echo "Not Error\n";
}

// Test without exceptional messages
$isError = $contact->details('8548036')->isErrorResponse();
if($isError) {
    echo "Error\n";
} else {
    echo "Not Error\n";
}

