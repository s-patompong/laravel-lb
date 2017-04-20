<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesCustomer;

// Setup user id and api key
$userId = getenv('LB_LIVE_AUTH_USERID');
$apiKey = getenv('LB_LIVE_API_KEY');

$customer = new LogicBoxesCustomer();

$customerDetail = [
	"username" => "test_lb_customer40@netearth.net",
	"passwd" => "qwerty123456",
	"name" => "Netearth Test1",
	"company" => "IDC (Thailand)",
	"address-line-1" => "123 Thailand",
	"city" => "Bangkok",
	"state" => LogicBoxesCustomer::STATE_NOT_APPLICABLE,
	"other-state" => "Bangkok",
	"country" => "TH",
	"zipcode" => "10110",
	"phone-cc" => "66",
	"phone" => "955098991",
	"lang-pref" => "en",
];

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$customer->setTestMode(false)->setUserId($userId)->setApiKey($apiKey);

$response = $customer->signup($customerDetail)->toArray();

print_r($response);
