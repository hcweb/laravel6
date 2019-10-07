<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use Closure;

class AuthPermission
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
//        if (auth()->check()){
//            \View::share('adminMenu', $this->getAllMenus());
//            \View::share('adminSelectMenu', $this->getSelectMenu());
//
//        }
//        abort(403);
        return $next($request);
    }
}
