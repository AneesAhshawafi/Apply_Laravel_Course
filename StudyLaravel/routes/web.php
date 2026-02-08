<?php

use App\Http\Controllers\ResFlightController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Flight;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\CountryController;
// Route::get('/anees', function () {
//     return "Hello Anis";
// });
// Route::get('/anees/{age?}/{name?}', function ($age = 20, $name = "Anees") {
//     return "Your age is " . $age . " and your name is " . $name;
// })->whereNumber('age')->whereAlpha('name');
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::prefix('anees')->group(function () {
//     Route::get('/age/{age?}', function ($age = 20) {
//         return "Your age is " . $age;
//     });
//     Route::get('/name/{name?}', function ($name = "Anees") {
//         return "Your name is " . $name;
//     });
// });

// route::get('/anees/amer/{age}', function ($age) {
//     return "Hello Anees ut age is" . $age;
// })->name('aneesage');
// route::fallback(function () {
//     return "Page Not Found : 404";
// });
// route::get('/login', [UserController::class, 'login']);
// route::get('/home', [UserController::class, 'home']);
// route::get('/master', function () {
//     return view('master');
// });
// route::get('/article', function () {
//     return view('article');
// });
// route::get('/post', function () {
//     return view('post');
// });

// route::get('flights', [FlightController::class, 'index']);
// route::get('flights/create', [FlightController::class, 'create'])->name('flights.create');
// route::post('flights/store', [FlightController::class, 'store'])->name('flights.store');
// route::get('flights/edit/{Id}', [FlightController::class, 'edit'])->name('flights.edit');
// route::post('flights/update', [FlightController::class, 'update'])->name('flights.update');
// route::get('flights/delete/{Id}', [FlightController::class, 'destroy'])->name('flights.destroy');
route::resource('flights', ResFlightController::class)->except(['show']);
// route:resource('flights',ResFlightController::class)->only(['index','create','store','edit','update','destroy']);
route::resource('countries', CountryController::class)->except(['show']);
// route::resources([
//     'flights' => ResFlightController::class,
//     'countries' => CountryController::class,    
// ]);

route::get('flights/delete/{id}',[ResFlightController::class,'delete'])->name('flights.delete');
route::get('flights/restore/{id}',[ResFlightController::class,'restore'])->name('flights.restore');