<?php

use App\Http\Controllers\API\CourseController;
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

// Manual Api
// Route::get("/courses", [CourseController::class, "index"]);
// Route::get("/courses/{id}", [CourseController::class, "show"]);
// Route::post("/courses", [CourseController::class, "store"]);
// Route::put("/courses/{id}", [CourseController::class, "update"]);
// Route::delete("/courses/{id}", [CourseController::class, "destroy"]);
Route::delete("/delete_course/{id}", [CourseController::class, "delete"]);
Route::get("/trashed_courses", [CourseController::class, "trash"]);
Route::get("/restore_course/{id}", [CourseController::class, "restore"]);



// Automatic Api Routes generation
Route::apiResource("courses", CourseController::class);//this automaticly generate the following routes:
// Route::get("/courses", [CourseController::class, "index"]);
// Route::get("/courses/{id}", [CourseController::class, "show"]);
// Route::post("/courses", [CourseController::class, "store"]);
// Route::put("/courses/{id}", [CourseController::class, "update"]);
// Route::delete("/courses/{id}", [CourseController::class, "destroy"]);
