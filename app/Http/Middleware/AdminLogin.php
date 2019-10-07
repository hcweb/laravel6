<?php

namespace App\Http\Middleware;

use Closure;

class AdminLogin
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
        if (auth()->guest()) {
            return redirect()->route('backend.login');
        }
        //获取皮肤
        //$skin = Skin::where('user_id', auth()->id())->first();

        //\View::share('skin', $skin);
        return $next($request);
    }
}
