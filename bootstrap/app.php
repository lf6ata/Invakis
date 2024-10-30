<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\PreventLoggedIn;
use App\Http\Middleware\User;
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
        $middleware->alias([
        'permission' => PermissionMiddleware::class,
        'role' => RoleMiddleware::class,
        'preventloggedin' => PreventLoggedIn::class,
        'admin' => Admin::class,
        'user' => User::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
