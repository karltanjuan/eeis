<?php

namespace App\Http\Middleware;

use Closure;

class IsCSS
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
        if(auth()->user()->is_css == 1) {
            return $next($request);
        }
        
        return redirect('/login')->with('error',"You don't have css access.");
    }
}
