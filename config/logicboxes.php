<?php

return [

	"test_mode" => env('LB_TEST_MODE', true),

	"credentials" => [
		"test" => [
			"auth_userid" => env('LB_TEST_AUTH_USERID', ''),
			"api_key" => env('LB_TEST_API_KEY', ''),
		],
		"live" => [
			"auth_userid" => env('LB_LIVE_AUTH_USERID', ''),
			"api_key" => env('LB_LIVE_API_KEY', ''),
		],
	],

	"no_of_record" => env('LB_NO_OF_RECORDS', 100),

	"interface" => env('LB_INTERFACE', null),

	'throw_exception' => false,

];
