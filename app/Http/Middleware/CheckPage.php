<?php

namespace App\Http\Middleware;

use App\Models\Cmspage;
use Illuminate\Support\Facades\DB;
use Closure;

class CheckPage
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
        $url = $request->route()->parameter('url');
          $page = Cmspage::where(DB::raw('BINARY `url`'), $url )->first();
          if($page == ''){
              return redirect()->route('404');
          }


        return $next($request);
    }
}
