<?php

namespace App\Http\Middleware;

use Closure;

class VerifyCmsSession
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
        if(!$request->session()->has('loggedCms'))
        {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
