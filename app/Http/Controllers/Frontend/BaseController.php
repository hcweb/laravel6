<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //获取栏目大分类
    protected function getMainMenu(){
        return Category::with('mould')
            ->where(['is_show'=>1,'parent_id'=>null])
            ->orderBy('created_at','ASC')
            ->get(['id','title','alias','mould_id','icon_class','color']);
    }
}
