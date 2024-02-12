<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('loggedInUser') && ($request->path() != '/' && $request->path() != '/register')) {
            return redirect('/');
        }
        if (session()->has('loggedInUser') && ($request->path() == '/' || $request->path() == '/register')) {
            return back();
        }
        return $next($request);
    }
}
