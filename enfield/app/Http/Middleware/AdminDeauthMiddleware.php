<?php

namespace App\Http\Middleware;

use Closure;

class AdminDeauthMiddleware
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
        if(!\Auth::check() ||  (\Auth::check() && !\Auth::user()->hasRole('Admin'))){
            return $next($request);
        }else if(\Auth::check() && \Auth::user()->hasRole('Admin')){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('home'); 
        }
    }
}
