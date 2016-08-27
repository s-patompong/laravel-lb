<?php

// Report only error message
error_reporting(E_ERROR);

require __DIR__.'/../vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__."/../");
$dotenv->load();