<?php

namespace App\Http\Middleware;

use Closure;

class VerifyFrontSession
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
        if($request->session()->has('loggedUser'))
        {
            return redirect()->route('dashboard');
        }
        else if($request->session()->has('loggedCms'))
        {
            return redirect()->route('cms');
        }
        else{
            return $next($request);
        }
    }
}
