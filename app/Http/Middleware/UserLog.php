<?php

namespace App\Http\Middleware;

use App\Models\Log;
use Closure;

class UserLog
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
        if (\Auth::check()){
            $user_name=\Auth::user()['name'];
        };
        $data['url']=$request->route()->getName();
        $data['operator']=$user_name ?? '';
        $data['operate_ip']=$request->ip();
        $data['description']='112312313';
        $data['operate_time']=date('Y-m-d H:i:s');
        Log::create($data);
        return $next($request);
    }
}
