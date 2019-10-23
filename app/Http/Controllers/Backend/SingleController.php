<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Field;
use App\Models\Single;
use Illuminate\Http\Request;

class SingleController extends BaseController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mould_id=\request()->get('mid');
        $fields=$this->getFieldsByMouldId($mould_id);
        return view('backend.single.create',compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->all() as $k=>$v){
            if (is_array($request->get($k))){
                $request[$k]=implode(',',$request->get($k));
            }
        }
        $single=Single::create($request->except('file'));
        if ($single){
            return redirect("admin/single/$single->id/edit?cid=$single->category_id&mid=$single->mould_id")->with('successMsg', '单页创建成功!');
        }
        return back()->withInput()->withErrors('单页创建失败!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $f_data=Single::findOrFail($id);
        $fields=$this->getFieldsByMouldId($f_data->mould_id);
        return view('backend.single.edit',compact('fields','f_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Single  $single
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Single $single)
    {
        foreach ($request->all() as $k=>$v){
            if (is_array($request->get($k))){
                $request[$k]=implode(',',$request->get($k));
            }
        }
        //dd($request->all());
        //$single=Single::create($request->except('file','singleId'));
        if ($single->update($request->except('file','singleId'))){
            return redirect("admin/single/$single->id/edit?cid=$single->category_id&mid=$single->mould_id")->with('successMsg', '单页更新成功!');
        }
        return back()->withInput()->withErrors('单页更新失败!');
    }

    /**
     * 获取自定义模型字段
     * @param $id
     * @return mixed
     */
    private function getFieldsByMouldId($mid){
        return Field::where(['mould_id'=>$mid,'is_system'=>false])->get();
    }
}
