<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        //更新前処理
        // ログインしているかチェックphp artisan config:cache
        if (!$request->session()->exists('login')) {
            // ログイン画面にリダイレクト
            return redirect('/');
        }

        $response = $next($request);

        //更新後処理

        return $response;
    }
}
