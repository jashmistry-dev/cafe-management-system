<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {

       

        if (auth()->user()) {
            Auth::logout();
            return redirect('/login')->with('error', 'Unauthorized Access!'); 
        }else{
            return $next($request);

        }
        

    }
}
