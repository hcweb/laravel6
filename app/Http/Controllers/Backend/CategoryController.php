<?php

namespace App\Http\Controllers\Backend;

use App\Handlers\TranslateHandler;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Mould;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = $this->getCategorys();
        return view('backend.category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = $this->getCategorys();
        $moulds=$this->getModels();
        return view('backend.category.create', compact('categorys','moulds'));
    }


    /**
     * @param CategoryRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {

        if (is_array($request->get('font_style'))) {
            $request['font_style'] = implode(',', $request->get('font_style'));
        }
        if (Category::create($request->all())) {
            return redirect()->route('category.index')->with('successMsg', '栏目创建成功!');
        }
        return back()->withInput()->withErrors('栏目创建失败!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categorys = $this->getCategorys();
        $moulds=$this->getModels();
        return view('backend.category.edit', compact('category', 'categorys','moulds'));
    }


    /**
     * @param CategoryRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $id)
    {
        if (is_array($request->get('font_style'))) {
            $request['font_style'] = implode(',', $request->get('font_style'));
        }
        $cate=$this->findById($id);
        if ($cate->update($request->except('categoryId'))) {
            return redirect()->route('category.index')->with('successMsg', '栏目更新成功!');
        }
        return back()->withInput()->withErrors('栏目更新失败!');
    }


    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if (Category::destroy(explode(',',$id))) {
            return $this->sendSuccess("栏目删除成功!");
        }
        return $this->sendError("栏目删除失败!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request){

        $cate = $this->findById($request->get('id'));
        $cate->order=$request->get('order');

        if ($cate->save()) {
            return $this->sendSuccess("排序更新成功!");
        }
        return $this->sendError("排序更新失败!");
    }

    /**
     * 获取所有分类
     * @return mixed
     */
    protected function getCategorys(){
        return Category::with('mould')->orderBy('order','DESC')->withDepth()->get()->toFlatTree();
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function findById($id){
        return Category::findOrFail($id);
    }

    /**
     * 获取模型
     * @return mixed
     */
    protected function getModels(){
        return Mould::oldest()->where('status',1)->get();
    }


    /**
     * 批量导入栏目
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function importCate(){
        $file=\request()->file('cFile');
        $cid=\request()->get('cid');

        $cate=$this->findById($cid);

        $fileContent=\File::get($file->path());
        $str_encoding=mb_convert_encoding($fileContent, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5,ASCII');
        $result=explode("\r\n",trim($str_encoding));

        $bool=true;
        foreach ($result as $v){
            $data=[
                'title'=>$v,
                'mould_id'=>$cate->mould_id,
                'parent_id'=>$cate->id,
                'alias'=>(new TranslateHandler())->translate($v),
                'template_list'=>$cate->template_list,
                'template_show'=>$cate->template_show,
            ];
            if (Category::create($data)){
                $bool=true;
            }else{
                $bool=false;
            }
        }

        if ($bool) {
            return back()->with('successMsg', '栏目导入成功!');
        }
        return back()->withInput()->withErrors('栏目导入失败!');
    }
}
