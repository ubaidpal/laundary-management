<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckAdmin
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
        if(Auth::user()->type == 'ADMIN'){
            return $next($request);
        }
        else{
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'This Email is not belongs to Admin!']);
        }
        
    }
}
