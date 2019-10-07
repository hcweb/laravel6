<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends BaseController
{
    public function login(){
        if (\request()->isMethod('POST')){
            $field = filter_var(\request()->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
            \request()->merge([$field => \request()->input('username')]);
            if (auth('member')->attempt(\request()->only($field, 'password'))) {
                if (auth('member')->user()->is_enabled != 1) {
                    return back()->withErrors('尊敬的' . auth('member')->user()->name . '您的账户目前处理禁用状态,请联系管理员开启！');
                }
                if (\request()->session()->has('app_call_route')){
                    return redirect(session('app_call_route'));
                }else{
                    return redirect('/');
                }

            } else {
                return back()->withErrors("用户名或密码错误！");
            }
        }
        return view('frontend.member.login');
    }

    public function register(){
        return view('frontend.member.register');
    }

    public function logout(){
        auth('member')->logout();
        return redirect('/');
    }
}
