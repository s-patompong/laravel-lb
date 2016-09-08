# Laravel-lb
[![Build Status](https://travis-ci.org/pangpondpon/laravel-lb.svg?branch=master)](https://travis-ci.org/pangpondpon/laravel-lb)

This library let your laravel application talk with Logicboxes API with ease.


### How to install
1. Run `composer require pangpondpon/laravel-lb` to include this library to your project
2. Add `LaravelLb\LaravelLbServiceProvider::class` into your providers array in config/app.php
3. Run `php artisan vendor:publish` to publish the config file
4. Put your credential in config/logicboxes.php like so

```php
<?php

return [
	
	"test_mode" => env('LB_TEST_MODE', true),
	"auth_userid" => env('LB_AUTH_USERID', 'YOUR_USER_ID'),
	"api_key" => env('LB_API_KEY', 'YOUR_API_KEY'),

];
```


### How to use in Laravel Controller

Use case - Buy an ssl from comodo
```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use LaravelLb\LogicBoxesComodo;

class ComodoCertController extends Controller
{
	public $comodo;
    
    public function __construct()
    {
    	$this->comodo = new LogicBoxesComodo();
    }

	// Buy the ssl from comodo, see LogicBoxesComodo class for api call info
    public function buy()
    {
    	// Order buy use method add from LogicBoxesComodo class
        $response = $this->comodo->add([
          "domain-name" => "ssldemosite.com",
          "months" => 12,
          "customer-id" => ""52213365,
          "plan-id" => LogicBoxesComodo::POSITIVE_SSL,
          "invoice-option" => LogicBoxesComodo::NO_INVOICE
    	])->toArray();
        
        return $response;
    }
}

```
See more example in /example folder.