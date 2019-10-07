<?php

namespace App\Http\Middleware;

use Closure;

class MemberLoginMiddleware
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
        if (auth('member')->guest()) {
            //保存请求地址
            session(['app_call_route'=>$request->url()]);
            //保存请求参数
            session(['app_search_parame'=>$request->all()]);
            return redirect()->route('home.member.login');
        }
        return $next($request);
    }
}
