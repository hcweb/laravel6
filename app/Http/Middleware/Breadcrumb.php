<?php

namespace App\Http\Middleware;

use Closure;

class Breadcrumb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->route()->getName() != 'backend.home') {
            \View::share('breadcrumbs', getBreadcrumbs());
        }
        return $next($request);
    }
}
