# Laravel-lb
[![Build Status](https://travis-ci.org/pangpondpon/laravel-lb.svg?branch=master)](https://travis-ci.org/pangpondpon/laravel-lb)

This library let your laravel application talk with Logicboxes API with ease.


### How to install
1. Run `composer require composer require pangpondpon/laravel-lb` to include this library to your project
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


### Example from test case
```php
<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use LaravelLb\Logicboxes;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {  
        $lb = new Logicboxes;
        $response = $lb->setResource('resellers')->setMethod('search')->setVariables([
            "no-of-records" => 10,
            "page-no" => 3,
        ])->call();
        dd($response); // Show response
    }
}

```
