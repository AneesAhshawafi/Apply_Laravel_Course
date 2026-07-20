<?php

use App\Http\Middleware\PoliceMan;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/students/web.php',
            __DIR__ . '/../routes/welcome/admin.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'PoliceMan' => PoliceMan::class
        ]); //route middleware on specific route
        $middleware->web(append: [SetLocale::class]); //global middelware
        // // Inactive the encryption for a specified cookie by its name
        // $middleware->encryptCookies(except: [
        //     'cookie_name',
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
