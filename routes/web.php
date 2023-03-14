<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')
    ->group(function () {
        Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('home');
        Route::get('/about', [\App\Http\Controllers\IndexController::class, 'about'])->name('about');

        Route::resource('users', \App\Http\Controllers\UserController::class);
    });

Route::controller(\App\Http\Controllers\AuthController::class)
    ->group(function () {
        Route::post('/login', 'login')->name('login')->middleware('guest');
        Route::delete('/logout', 'logout')->name('logout')->middleware('auth');
    });

Route::inertia('/login', 'Login');

