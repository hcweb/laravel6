<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Field;
use App\Models\Mould;
use App\Models$fileName;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator;

class DfgdfgdfgdfController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mould_id=request()->get('mid');
        $mould_name=$this->getMouldNameById($mould_id);
        $subCate=Category::descendantsAndSelf(request('cid'),['id']);
        $ids=$subCate->pluck('id');
       if (count($ids) > 0){
           $post_data=Dfgdfgdfgdf::with('category')
               ->where('mould_id',request('mid'))
               ->whereIn('category_id',$ids)
               ->paginate(config('base_config.page_number'));
       }else{
        $post_data=Dfgdfgdfgdf::with('category')
            ->where(['mould_id'=>request('mid'),'category_id'=>request('cid')])
            ->paginate(config('base_config.page_number'));
       }
        return view('backend.dfgdfgdfgdf.index',compact('post_data','mould_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mould_id=request()->get('mid');
        $fields=$this->getFieldsByMouldId($mould_id);
        $tags=Tag::all();
        $mould_name=$this->getMouldNameById($mould_id);
        return view('backend.dfgdfgdfgdf.create',compact('fields','tags','mould_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //数据验证
        $fields = getFieldsByModelId((int)$request->get('mould_id'));
        $hasValidate = array();
        foreach ($fields as $v) {
            //如果填写了验证规则，就进行验证
            if (!is_null($v->validate)) {
                array_push($hasValidate, $v);
            }
        }

        if (count($hasValidate) > 0) {
            $rules = collect([]);
            foreach ($hasValidate as $v) {
                $rules->put($v->name, $v->validate);
            }
            $validator = Validator::make($request->all(), $rules->all());
            if ($validator->fails()) {
                return redirect()
                    ->route('dfgdfgdfgdf.create',['mid'=>$request->get('mould_id'),'cid'=>$request->get('category_id')])
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        foreach ($request->all() as $k=>$v){
            if (is_array($request->get($k))){
                $request[$k]=implode(',',$request->get($k));
            }
        }
        if ($Dfgdfgdfgdf=Dfgdfgdfgdf::create($request->except(['file','tags']))) {
            //保存标签
            if ($request->get('tags') != null){
                $Dfgdfgdfgdf->syncTags(explode(',',$request->get('tags')));
            }


            return redirect()->route('dfgdfgdfgdf.index',['id'=>$Dfgdfgdfgdf->id,'cid'=>$Dfgdfgdfgdf->category_id,'mid'=>$Dfgdfgdfgdf->mould_id])->with('successMsg', '文档创建成功!');
        }
        return back()->withInput()->withErrors('文档创建失败!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\{Dfgdfgdfgdf}  $Dfgdfgdfgdf
     * @return \Illuminate\Http\Response
     */
    public function show(Dfgdfgdfgdf $Dfgdfgdfgdf)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $mould_id=request()->get('mid');
        $fields=$this->getFieldsByMouldId($mould_id);
        $tags=Tag::all();
        $mould_name=$this->getMouldNameById($mould_id);
        $f_data=Dfgdfgdfgdf::findOrFail($id);
        return view('backend.dfgdfgdfgdf.edit',compact('fields','tags','mould_name','f_data'));
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {
        //数据验证
        $Dfgdfgdfgdf=Dfgdfgdfgdf::findOrFail($id);
        $fields = getFieldsByModelId((int)$request->get('mould_id'));
        $hasValidate = array();
        foreach ($fields as $v) {
            //如果填写了验证规则，就进行验证
            if (!is_null($v->validate)) {
                if (Str::contains($v->validate,'unique')){
                    $r_result=explode('|',$v->validate);
                    foreach ($r_result as $m=>$n){
                        if (Str::contains($n,'unique')){
//                            echo $n;
                            $r_result[$m]=Rule::unique(explode(':',$n)[1])->ignore($id);
                            $v->validate = $r_result;
                        }
                    }
                }
                array_push($hasValidate, $v);
            }
        }

        if (count($hasValidate) > 0) {
            $rules = collect([]);
            foreach ($hasValidate as $v) {
                $rules->put($v->name, $v->validate);
            }
            $validator = Validator::make($request->all(), $rules->all());
            if ($validator->fails()) {
                return redirect()
                    ->route('dfgdfgdfgdf.edit',['mid'=>$request->get('mould_id'),'cid'=>$request->get('category_id')])
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        foreach ($request->all() as $k=>$v){
            if (is_array($request->get($k))){
                $request[$k]=implode(',',$request->get($k));
            }
        }
        if ($Dfgdfgdfgdf->update($request->except(['file','tags']))) {
            //保存标签
            if ($request->get('tags') != null){
                $Dfgdfgdfgdf->syncTags(explode(',',$request->get('tags')));
            }


            return redirect()->route('dfgdfgdfgdf.index',['id'=>$Dfgdfgdfgdf->id,'cid'=>$Dfgdfgdfgdf->category_id,'mid'=>$Dfgdfgdfgdf->mould_id])->with('successMsg', '文档更新成功!');
        }
        return back()->withInput()->withErrors('文档更新失败!');
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (Dfgdfgdfgdf::destroy(explode(',',$id))) {
            return $this->sendSuccess("文档删除成功!");
        }
        return $this->sendError("文档删除失败!");
    }

    /**
     * 获取自定义模型字段
     * @param $id
     * @return mixed
     */
    private function getFieldsByMouldId($mid){
        return Field::where(['mould_id'=>$mid,'is_system'=>false])->orderBy('order','DESC')->get();
    }

    //获取模型名称
    private function getMouldNameById($mid){
        return Mould::where('id',$mid)->value('table_name');
    }
}