<?php
//-------------------------------------------------
// ルート [Web.php]
// Author:Kenta Nakamoto
// Data:2024/06/11
//-------------------------------------------------

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// ログイン画面の表示
Route::get('/', [AccountController::class, 'showLogin']);

Route::prefix('accounts')->name('accounts.')->controller(AccountController::class)
    ->group(function (){
        // ログイン画面の表示
        Route::get('/', 'showLogin')->name('/');
        Route::get('showLogin', 'showLogin')->name('showLogin');
        // ログイン処理
        Route::post('doLogin', 'doLogin')->name('dologin');
        // アカウントの表示
        Route::get('showAccount/{account_id?}', 'showAccount')->name('show');
    });

// ログアウト処理
Route::post('accounts/doLogout', [AccountController::class, 'doLogout']);


// アイテムの表示
Route::get('accounts/showItem/{item_id?}', [AccountController::class, 'showItem']);

// 所持アイテムの表示
Route::get('accounts/showHaveItem/{player_id?}', [AccountController::class, 'showHaveItem']);
