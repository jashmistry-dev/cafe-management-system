<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {


        if (!auth()->check()) {
            return redirect()->route('login'); // 👈 FIX
        }

        if (auth()->user()->role !== 'admin') {
            Auth::logout();
            return redirect('/login')->with('error', 'Unauthorized Access!');; // 👈 FIX

        }

        return $next($request);
    }
}
