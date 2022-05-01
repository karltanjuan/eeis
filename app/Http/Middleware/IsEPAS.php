<?php

namespace App\Http\Middleware;

use Closure;

class IsEPAS
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
        if(auth()->user()->is_epas == 1){
            return $next($request);
        }

        return redirect('/login')->with('error',"You don't have css access.");
    }
}
