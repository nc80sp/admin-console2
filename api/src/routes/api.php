<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\NoCacheMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//ログイン前
Route::controller(AuthController::class)->group(function () {
    //ユーザー登録
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
});

//ログイン後
Route::middleware(NoCacheMiddleware::class)->group(function () {
    /*->middleware("auth:sanctum")*/
    //ユーザー関係
    Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
        //ユーザー情報取得
        Route::get('/', 'index')->name('index');
        Route::get('{user_id}', 'show')->name('show')->where('user_id', '[0-9]+');
        //ユーザー情報更新
        Route::post('update', 'update')->middleware('auth:sanctum')->name('update');
    });
    //フォロー関係
    Route::prefix('follows')->controller(FollowController::class)->name('follows.')->group(function () {
        //フォロー情報取得
        Route::get('{user_id}', 'show')->name('show');
        //フォロー登録
        Route::post('store', 'store')->middleware('auth:sanctum')->name('store');
        //フォロー削除
        Route::post('destroy', 'destroy')->middleware('auth:sanctum')->name('destroy');
    });
    //アイテム関係
    Route::prefix('items')->controller(ItemController::class)->name('items.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('store', 'store')->middleware('auth:sanctum')->name('store');
    });
    //メール関係
    Route::prefix('mails')->controller(MailController::class)->name('mails.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('update', 'update')->middleware('auth:sanctum')->name('update');
    });
    //ステージ関係
    Route::prefix('stages')->controller(StageController::class)->name('stages.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('record', 'record')->name('record');
        Route::post('store', 'store')->middleware('auth:sanctum')->name('store');
        Route::get('{user_id}', 'show')->name('show');
    });
});
