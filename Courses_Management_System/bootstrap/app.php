<?php

use App\Http\Middleware\PoliceMan;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/welcome/admin.php',
        ],
        api: [
            __DIR__ . '/../routes/api.php',
            __DIR__ . '/../routes/api_v2.php',
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

    // Discover Listeners, if you dont identify the listeners paths, it will discover the difault path which is app/listeners
    ->withEvents(discover: [
        __DIR__ . '/../app/Listeners_Domain/Orders/Listeners',
        __DIR__ . '/../app/Listeners', //if you did not define it here it will be ignored (like the default constructo  )
    ])
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
