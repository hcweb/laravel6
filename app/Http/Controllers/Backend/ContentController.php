<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Mould;
use App\Models\Single;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentController extends BaseController
{
    //文章模型
    const POST_MOULD=1;
    //留言模型
    const GUEST_BOOK_MOULD=4;
    //单页模型
    const SINGLE_MOULD=5;
    //下载模型
    const DOWNLOAD_MOULD=3;
    //图集模型
    const IMAGE_MOULD=2;



    public function index(){
        $categorys=Category::orderBy('order','DESC')->withDepth()->get()->toTree();

        $traverse = function ($categories) use (&$traverse) {
            foreach ($categories as $v) {
                //获取模型信息
                $ctrName=Mould::select('ctr_name')->findOrFail($v->mould_id);

                //留言模型
                if ($v->mould_id == self::GUEST_BOOK_MOULD){
                    $v->iframe_url=route('guest_book.index',['id'=>$v->id,'mid'=>$v->mould_id]);
                }
                //单页模型
                elseif ($v->mould_id == self::SINGLE_MOULD){
                    if ($single=Single::where('category_id',$v->id)->first()){
                        $v->iframe_url=route('single.edit',['id'=>$single->id,'cid'=>$v->id,'mid'=>$v->mould_id]);
                    }else{
                        $v->iframe_url=route('single.create',['cid'=>$v->id,'mid'=>$v->mould_id]);
                    }
                }else{
                    $v->iframe_url=action("Backend\\".$ctrName->ctr_name.'@index',['cid'=>$v->id,'mid'=>$v->mould_id]);
                }
                $traverse($v->children);
            }
        };
        $traverse($categorys);
        return view('backend.content.index',compact('categorys'));
    }

    public function text(){
        return view('backend.home.test');
    }
}
