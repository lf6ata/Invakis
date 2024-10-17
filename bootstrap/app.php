<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;

// $app->register(\Barryvdh\DomPDF\ServiceProvider::class);
// $app->configure('dompdf');

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware = [
        'permission' => PermissionMiddleware::class,
        'role' => RoleMiddleware::class,
        ];
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
