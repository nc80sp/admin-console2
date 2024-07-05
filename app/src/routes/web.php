<?php
//-------------------------------------------------
// ルート [Web.php]
// Author:Kenta Nakamoto
// Data:2024/06/11
//-------------------------------------------------

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\NoCacheMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(NoCacheMiddleware::class)->group(function () {

// 認証関係
// ログイン画面の表示
    Route::get('/', [AuthController::class, 'index'])->name('auth.index');
    Route::prefix('auth')->name('auth.')->controller(AuthController::class)
        ->group(function () {
            // ログイン処理
            Route::post('login', 'login')->name('login');
            // ログアウト処理
            Route::get('logout', 'logout')->name('logout');
        });

// アカウント関係
    Route::prefix('accounts')->middleware(AuthMiddleware::class)->name('accounts.')->controller(AccountController::class)
        ->group(function () {
            // アカウントの表示
            Route::get('index', 'index')->name('index');
            Route::get('show/{account_id?}', 'show')->name('show');
            Route::get('create', 'create')->name('create');
            Route::get('delete', 'delete')->name('delete');
            Route::post('store', 'store')->name('store');
            Route::post('destroy', 'destroy')->name('destroy');
            Route::get('edit', 'edit')->name('edit');
            Route::post('update', 'update')->name('update');
        });


    Route::prefix('items')->name('items.')->controller(ItemController::class)
        ->group(function () {
            Route::get('index', [ItemController::class, 'index'])->name('index');
        });

    Route::prefix('mails')->name('mails.')->controller(MailController::class)
        ->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
        });

    Route::prefix('users')->name('users.')->controller(UserController::class)
        ->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('items/index', 'showItem')->name('showItem');
            Route::get('mails/index', 'showMail')->name('showMail');
            Route::get('follows/index', 'showFollow')->name('showFollow');
        });

});
