<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends BaseController
{
//    public function main(){
//        return view('backend.app');
//    }

    public function index(){
        return view('backend.home.index');
    }

    /**
     * 判断用户是否已经登录
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth(){
        if (\Auth::check()){
            return redirect()->route('backend.home');
        }
        return redirect()->route('backend.login');
    }

    public function fileManger(){
        return view('backend.home.file');
    }

    public function test(){
        return view('backend.home.index');
    }

    /**
     * 清除缓存
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCache(){
        \Artisan::call('config:cache');
        \Artisan::call('route:cache');
        sleep(5);
        return back();
    }
}
