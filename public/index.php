<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...

require __DIR__.'/../vendor/autoload.php';

// require '/home/bitnami/pericles/vendor/autoload.php';


// Bootstrap Laravel and handle the request...
/** @var Application $app */

$app = require_once __DIR__.'/../bootstrap/app.php';

// $app = require_once '/home/bitnami/pericles/bootstrap/app.php';
// $app->bind('path.public', function () {
//     return __DIR__; // __DIR__ es '/opt/bitnami/apache/htdocs'
// });

$app->handleRequest(Request::capture());
