<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
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
        //dd(Auth::user());

        if(!Auth::check()) {
            return redirect('/admin');
        } elseif (Auth::check() && Auth::user()->is_admin != 1) {
            return redirect('/');
        }

        return $next($request);
    }
}
