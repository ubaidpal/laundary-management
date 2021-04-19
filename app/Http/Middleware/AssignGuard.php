<?php

namespace App\Http\Middleware;

use App\Coach;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AssignGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,  $guard = null)
    {

        if($guard == 'staff'){
            auth()->shouldUse($guard);
            if(Auth::user()->status == '0'){
                 return redirect()->route('restaurant.login')->withErrors(['error' => 'Your Account is not Activated. Please contact Admin.']);
            }
        }

        return $next($request);
    }
}
