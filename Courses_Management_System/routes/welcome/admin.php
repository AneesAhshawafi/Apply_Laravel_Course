<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

route::prefix("admin")->group(function () {
    Route::get('welcome', [WelcomeController::class, 'myCustomFacade'])->middleware(['throttle:limit4']);
});
