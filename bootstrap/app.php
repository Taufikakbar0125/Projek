<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Login/logout admin — bebas maintenance
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            // Panel admin — bebas maintenance, hanya cek auth
            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin'       => \App\Http\Middleware\AdminMiddleware::class,
            'maintenance' => \App\Http\Middleware\MaintenanceCheckMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
