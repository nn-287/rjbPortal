<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is authenticated
         if (!Auth::check()) 
         {
            return redirect('login');
        }

        $user = Auth::user();

        // Check if the user is a driver (is_driver = 1) or a user (is_driver = 0)
        if ($user->is_driver == '1' || $user->is_driver == '0') 
        {
            return $next($request);
        }

        // If the user does not have the correct role, redirect to login
        return redirect('login');
    }
}
