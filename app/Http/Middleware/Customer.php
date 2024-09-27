<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next): Response
    {
        if (auth()->user() && auth()->user()->isCustomer()) {
            return $next($request);
        }
        return redirect('/dashboard')->with('error', 'Permission denied! You do not have customer access.');
    }
}
