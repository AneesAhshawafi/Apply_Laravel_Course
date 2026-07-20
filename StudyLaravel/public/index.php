<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}
// Register the Composer autoloader...
require __DIR__ . '/../vendor/autoload.php'; // loading the framework
dump("AR");

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';
dump("5");
$app->handleRequest(Request::capture());
dump("6");
