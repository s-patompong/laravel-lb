<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesReseller;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$reseller = new LogicBoxesReseller('');

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$reseller->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

$variables = [
	'username' => 'sales@mddhosting.com',
    'passwd' => 'TQbAvJ6B7a',
    'name' => 'Michael Denney',
    'company' => 'MDDHosting LLC',
    'address-line-1' => '5239 E State Road 144',
    // 'address-line-2' => '',
    // 'address-line-3' => '',
    'city' => 'Mooresville',
    'state' => 'Indiana',
    'country' => 'US',
    'zipcode' => '46158',
    'phone-cc' => '1',
    'phone' => '3176080643',
    // 'mobile-cc' => '',
    // 'mobile' => '',
    'fax-cc' => '1',
    'fax' => '3176080643',
    'lang-pref' => 'en',
    'accounting-currency-symbol' => 'USD',
    'selling-currency-symbol' => 'USD',
    'vat-id' => '',
];

$response = $reseller->signup($variables);
