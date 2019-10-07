<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends BaseController
{
    /**
     * 使用帮助
     * @return \Illuminate\Http\RedirectResponse
     */
    public function help(){
        $page=Page::where('alias','help')->first();
        if ($page){
            return redirect()->route('page.edit',['alias'=>'help']);
        }
        return redirect()->route('page.create',['alias'=>'help']);
    }

    /**
     * 联系我们
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactUs(){
        $page=Page::where('alias','contact_us')->first();
        if ($page){
            return redirect()->route('page.edit',['alias'=>'contact_us']);
        }
        return redirect()->route('page.create',['alias'=>'contact_us']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.page.create',compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($page=Page::create($request->all())){
            return redirect()->route('page.edit',['alias'=>$page->alias])->with('successMsg', '单页创建成功!');
        }
        return back()->withInput()->withErrors('单页创建失败!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $alias
     * @return \Illuminate\Http\Response
     */
    public function edit($alias)
    {
        $page=Page::where('alias',$alias)->first();
        return view('backend.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
         if ($page->update($request->all())){
             return redirect()->route('page.edit',['alias'=>$page->alias])->with('successMsg', '单页更新成功!');
         }
        return back()->withInput()->withErrors('单页更新失败!');
    }
}
