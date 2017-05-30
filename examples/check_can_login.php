<?php

require __DIR__.'/autoload.php';

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$lb = new \LaravelLb\LogicBoxes;

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$lb->setUserId($userId)->setApiKey($apiKey);

if($lb->canLogin()) {
    echo "Can Login\n";
} else {
    echo "Can't Login\n";
}
