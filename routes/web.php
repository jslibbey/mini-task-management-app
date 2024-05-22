<?php

use App\Http\Controllers\Web\LoginController;
use Illuminate\Support\Facades\Route;



Route::get('register', [LoginController::class, 'register'])->name('register');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('{any?}', function () {
        return view('welcome');
    })->where('any', '.*');
});
