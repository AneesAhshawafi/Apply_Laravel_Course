<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/signup', [LoginController::class, 'signUp'])->name("signup");
Route::post("/login", [LoginController::class, "login"])->name("login");

Route::get('/test-api', function () {

    return response()->json([
        "name" => "Anees",
        "email" => "example@domain.com"
    ]);
})->middleware('auth:sanctum');
