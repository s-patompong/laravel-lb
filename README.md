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


### Examples
* See examples from examples/ folder.
* Copy .env.example to .env
* Change the data in .env according to your data

