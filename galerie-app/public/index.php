<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Composer autoload
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel app
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Handle the request
$request = Request::capture();
$response = $app->handle($request);

// Send the response
$response->send();

// Terminate the application
$app->terminate($request, $response);
