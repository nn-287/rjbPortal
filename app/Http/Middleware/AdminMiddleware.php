<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\LaravelDebugbar;

class AdminMiddleware
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
        \Barryvdh\Debugbar\Facades\Debugbar::enable();
        if (Auth::guard('admin')->check()) {
            return $next($request);
            
        } 
     
        return redirect()->route('admin.auth.login');
    }
}
