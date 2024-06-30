<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        $response = $next($request);
        $response->withHeaders([
            'Cache-Control' => 'no-store',
            'Max-Age' => 0,
        ]);
        return $response;
    }
}
