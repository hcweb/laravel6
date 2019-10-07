<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Browser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

class BrowserController extends Controller
{
    public function index(){
        $browser=Browser::where('member_id',auth('member')->id())->orderBy('created_at','desc')->get();
        $data=array();
        foreach ($browser as $v){
            $model="App\\Models\\".$v->mould;
            $result=$model::findOrFail($v->p_id);
            array_push($data,$result);
        }
//        $data=array_unique($data);
        return view('frontend.browser.index',compact('data'));
    }
}
