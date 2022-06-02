<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ComingSoonCheck
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

            if( env('COMING_SOON') && ! Auth::check() &&  $request->route()->uri != 'coming-soon') {
                return redirect('/coming-soon', 302);
            }
            elseif( env('COMING_SOON') && Auth::check() &&  $request->route()->uri == 'coming-soon' ) {
                return redirect('/');
            }
            elseif( env('COMING_SOON') == false && $request->route()->uri == 'coming-soon') {
                return redirect('/');
            }

        return $next($request);
    }
}
