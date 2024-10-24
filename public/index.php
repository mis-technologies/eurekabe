<?php

use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Function to ensure directory exists
function ensureDirectoryExists($dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true); // Create directory recursively
    }
}

// Ensure the required directories exist
ensureDirectoryExists(__DIR__.'/../storage/framework');
ensureDirectoryExists(__DIR__.'/../bootstrap/cache');

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
