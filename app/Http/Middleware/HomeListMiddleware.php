<?php

namespace App\Http\Middleware;

use Closure;

class HomeListMiddleware
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
        $fullUrl=$request->fullUrl();
        dd($fullUrl);
        return $next($request);
    }
}
