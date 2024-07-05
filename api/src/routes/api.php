<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CacheMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(RegisterController::class)->group(function () {
    Route::post('register', 'register')->name('register');
    Route::get('login', 'login')->name('login');
});

Route::middleware(CacheMiddleware::class)->/*middleware("auth:sanctum")->*/ group(function () {
    Route::apiResource('users', UserController::class);
    Route::get('users/follows/', [UserController::class, 'getFollows']);
});
