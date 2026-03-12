<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

if (PHP_VERSION_ID >= 80500) {
    // Laravel 11 still references legacy PDO MySQL SSL constants that are deprecated in PHP 8.5.
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Trust proxy headers from Railway / reverse proxy so Laravel detects HTTPS correctly.
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
