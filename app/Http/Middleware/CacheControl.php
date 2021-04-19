<?php

namespace App\Http\Middleware;

use App\Coach;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class CacheControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // $response->header('Cache-Control', 'no-store, must-revalidate');


        return $response;
    }
}
