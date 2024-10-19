<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
       
        if (Auth::check()) 
        {
            if (Auth::user()->is_driver !== '1')
            {
                return $next($request);
            }
        }
        return response()->json(['error' => 'Unauthorized. Only regular users are allowed.'], 403);
    
    }
}
