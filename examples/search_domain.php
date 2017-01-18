<?php

require __DIR__.'/autoload.php';

use LaravelLb\LogicBoxesDomain;

// Setup user id and api key
$domain = new LogicBoxesDomain();

/** No need to set user id if you're using Laravel, it will automatically get the credential from config/logicboxes.php */
$domain->setUserId('344942')->setApiKey('G1yUFFklt9BBL2UohjI5j8vgCzHtO2qL');

$parameters = [
  'show-child-orders' => 'false',
  'no-of-records' => '100',
  'page-no' => '1',
  'order-by' => 'creationtime',
  'product-key' => 'thirdleveldotuk',
  'status' => 'Active'
];
$domain->setAppends(['product-key' => 'secondleveldotuk']);
$response = $domain->search($parameters)->toJson();
print_r($response);
