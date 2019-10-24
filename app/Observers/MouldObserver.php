<?php

namespace App\Observers;

use App\Http\Controllers\Backend\BaseController;
use App\Models\Category;
use App\Models\Field;
use App\Models\Mould;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MouldObserver
{
    //
    public function deleted(Mould $mould)
    {
        $fileName=Str::studly($mould->table_name);

        \Schema::dropIfExists($mould->table_name);
        $mould->fields()->delete();

        //删除动态路由
        if (\File::exists(base_path('routes/admin_route.php'))){
            $route_content=\File::get(base_path('routes/admin_route.php'));
            $route_content_result=str_replace("Route::resource('$mould->table_name', '{$mould->ctr_name}');","",$route_content);
            \File::put(base_path('routes/admin_route.php'),str_replace("  ","",$route_content_result));
        }

        //删除控制器
        if (\File::exists(app_path('Http/Controllers/Backend/'.$fileName.'Controller.php'))){
            \File::delete(app_path('Http/Controllers/Backend/'.$fileName.'Controller.php'));
        }

        //删除模型
        if (\File::exists(app_path('Models/'.$fileName.'.php'))){
            \File::delete(app_path('Models/'.$fileName.'.php'));
        }


        //删除后端视图
        if (is_dir(resource_path('views/backend/'.$mould->table_name))){
            \File::deleteDirectory(resource_path('views/backend/'.$mould->table_name));
        }

        //刪除前端视图
        if (\File::exists(resource_path('views/frontend/list_'.$mould->table_name.'.blade.php'))){
            \File::delete(resource_path('views/frontend/list_'.$mould->table_name.'.blade.php'));
        }
        if (\File::exists(resource_path('views/frontend/view_'.$mould->table_name.'.blade.php'))){
            \File::delete(resource_path('views/frontend/view_'.$mould->table_name.'.blade.php'));
        }

        //删除关联id
        if (\Schema::hasColumn('model_tag',$mould->table_name.'_id')) {
            \Schema::table('model_tag', function ($table) use ($mould) {
                $table->dropColumn($mould->table_name.'_id');
                $table->dropForeign('model_tag_'.$mould->table_name.'_id'.'_foreign');
            });
        }


        //删除属于本模型的栏目
        $mould->categories()->delete();
    }

    public function created(Mould $mould)
    {
        //文件名称，驼峰式
        $fileName=Str::studly($mould->table_name);

        //向数据库中添加字段
        $data=[
            ['title'=>'文章标题','mould_id'=>$mould->id,'name'=>'title','is_system'=>true,'type'=>'text'],
            ['title'=>'文章别名','mould_id'=>$mould->id,'name'=>'alias','is_system'=>true,'type'=>'text'],
            ['title'=>'是否发布','mould_id'=>$mould->id,'name'=>'is_show','is_system'=>true,'type'=>'radio'],
            ['title'=>'允许评论','mould_id'=>$mould->id,'name'=>'is_comment','is_system'=>true,'type'=>'radio'],
            ['title'=>'置顶','mould_id'=>$mould->id,'name'=>'is_top','is_system'=>true,'type'=>'checkbox'],
            ['title'=>'热门','mould_id'=>$mould->id,'name'=>'is_hot','is_system'=>true,'type'=>'checkbox'],
            ['title'=>'推荐','mould_id'=>$mould->id,'name'=>'is_tuijian','is_system'=>true,'type'=>'checkbox'],
            ['title'=>'幻灯','mould_id'=>$mould->id,'name'=>'is_slide','is_system'=>true,'type'=>'checkbox'],
            ['title'=>'封面图片','mould_id'=>$mould->id,'name'=>'thumb','is_system'=>true,'type'=>'img'],
            ['title'=>'字体样式','mould_id'=>$mould->id,'name'=>'font_style','is_system'=>true,'type'=>'checkbox',],
            ['title'=>'字体颜色','mould_id'=>$mould->id,'name'=>'color','is_system'=>true,'type'=>'text'],
            ['title'=>'排序','mould_id'=>$mould->id,'name'=>'order','is_system'=>true,'type'=>'int'],
            ['title'=>'浏览次数','mould_id'=>$mould->id,'name'=>'views','is_system'=>true,'type'=>'int'],
            ['title'=>'发布时间','mould_id'=>$mould->id,'name'=>'push_time','is_system'=>true,'type'=>'datetime'],
            ['title'=>'URL链接','mould_id'=>$mould->id,'name'=>'url','is_system'=>true,'type'=>'text'],
            ['title'=>'信息来源','mould_id'=>$mould->id,'name'=>'source','is_system'=>true,'type'=>'text'],
            ['title'=>'文章作者','mould_id'=>$mould->id,'name'=>'author','is_system'=>true,'type'=>'text'],
            ['title'=>'内容摘要','mould_id'=>$mould->id,'name'=>'summary','is_system'=>true,'type'=>'htmltext'],
            ['title'=>'内容描述','mould_id'=>$mould->id,'name'=>'description','is_system'=>true,'type'=>'htmltext'],
            ['title'=>'SEO标题','mould_id'=>$mould->id,'name'=>'seo_title','is_system'=>true,'type'=>'text'],
            ['title'=>'SEO关健字','mould_id'=>$mould->id,'name'=>'seo_key','is_system'=>true,'type'=>'multitext'],
            ['title'=>'SEO描述','mould_id'=>$mould->id,'name'=>'seo_content','is_system'=>true,'type'=>'multitext'],
            ['title'=>'创建时间','mould_id'=>$mould->id,'name'=>'created_at','is_system'=>true,'type'=>'datetime'],
            ['title'=>'更新时间','mould_id'=>$mould->id,'name'=>'updated_at','is_system'=>true,'type'=>'datetime']
        ];

        foreach ($data as $v){
            Field::create($v);
        }

        //設置标签关联主键
        \Schema::table('model_tag',function ($table) use ($mould){
            $id=$mould->table_name.'_id';
            $table->integer($id)->unsigned();
            $table->foreign($id)
                ->references('id')
                ->on($mould->table_name);
        });

        //写入路由
        $route_content=<<<EOF
Route::resource('$mould->table_name', '{$mould->ctr_name}');
EOF;

        \File::append(base_path('routes/admin_route.php'),$route_content);

        //创建控制器
        if (!\File::exists(app_path('Http/Controllers/Backend/'.$fileName.'Controller.php'))){
            $result=<<<EOF
<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Field;
use App\Models\Mould;
use App\Models\$fileName;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator;

class {$fileName}Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \$mould_id=request()->get('mid');
        \$mould_name=\$this->getMouldNameById(\$mould_id);
        \$subCate=Category::descendantsAndSelf(request('cid'),['id']);
        \$ids=\$subCate->pluck('id');
       if (count(\$ids) > 0){
           \$post_data={$fileName}::with('category')
               ->where('mould_id',request('mid'))
               ->whereIn('category_id',\$ids)
               ->paginate(config('base_config.page_number'));
       }else{
        \$post_data={$fileName}::with('category')
            ->where(['mould_id'=>request('mid'),'category_id'=>request('cid')])
            ->paginate(config('base_config.page_number'));
       }
        return view('backend.{$mould->table_name}.index',compact('post_data','mould_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \$mould_id=request()->get('mid');
        \$fields=\$this->getFieldsByMouldId(\$mould_id);
        \$tags=Tag::all();
        \$mould_name=\$this->getMouldNameById(\$mould_id);
        return view('backend.{$mould->table_name}.create',compact('fields','tags','mould_name'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  \$request
     * @return \Illuminate\Http\Response
     */
    public function store(Request \$request)
    {
        //数据验证
        \$fields = getFieldsByModelId((int)\$request->get('mould_id'));
        \$hasValidate = array();
        foreach (\$fields as \$v) {
            //如果填写了验证规则，就进行验证
            if (!is_null(\$v->validate)) {
                array_push(\$hasValidate, \$v);
            }
        }

        if (count(\$hasValidate) > 0) {
            \$rules = collect([]);
            foreach (\$hasValidate as \$v) {
                \$rules->put(\$v->name, \$v->validate);
            }
            \$validator = Validator::make(\$request->all(), \$rules->all());
            if (\$validator->fails()) {
                return redirect()
                    ->route('{$mould->table_name}.create',['mid'=>\$request->get('mould_id'),'cid'=>\$request->get('category_id')])
                    ->withErrors(\$validator)
                    ->withInput();
            }
        }

        foreach (\$request->all() as \$k=>\$v){
            if (is_array(\$request->get(\$k))){
                \$request[\$k]=implode(',',\$request->get(\$k));
            }
        }
        if (\${$fileName}={$fileName}::create(\$request->except(['file','tags']))) {
            //保存标签
            if (\$request->get('tags') != null){
                \${$fileName}->syncTags(explode(',',\$request->get('tags')));
            }


            return redirect()->route('{$mould->table_name}.index',['id'=>\${$fileName}->id,'cid'=>\${$fileName}->category_id,'mid'=>\${$fileName}->mould_id])->with('successMsg', '文档创建成功!');
        }
        return back()->withInput()->withErrors('文档创建失败!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\{$fileName}  \${$fileName}
     * @return \Illuminate\Http\Response
     */
    public function show({$fileName} \${$fileName})
    {
        //
    }

    /**
     * @param \$id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(\$id)
    {
        \$mould_id=request()->get('mid');
        \$fields=\$this->getFieldsByMouldId(\$mould_id);
        \$tags=Tag::all();
        \$mould_name=\$this->getMouldNameById(\$mould_id);
        \$f_data={$fileName}::findOrFail(\$id);
        return view('backend.{$mould->table_name}.edit',compact('fields','tags','mould_name','f_data'));
    }


    /**
     * @param Request \$request
     * @param \$id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request \$request,\$id)
    {
        //数据验证
        \${$fileName}={$fileName}::findOrFail(\$id);
        \$fields = getFieldsByModelId((int)\$request->get('mould_id'));
        \$hasValidate = array();
        foreach (\$fields as \$v) {
            //如果填写了验证规则，就进行验证
            if (!is_null(\$v->validate)) {
                if (Str::contains(\$v->validate,'unique')){
                    \$r_result=explode('|',\$v->validate);
                    foreach (\$r_result as \$m=>\$n){
                        if (Str::contains(\$n,'unique')){
//                            echo \$n;
                            \$r_result[\$m]=Rule::unique(explode(':',\$n)[1])->ignore(\$id);
                            \$v->validate = \$r_result;
                        }
                    }
                }
                array_push(\$hasValidate, \$v);
            }
        }

        if (count(\$hasValidate) > 0) {
            \$rules = collect([]);
            foreach (\$hasValidate as \$v) {
                \$rules->put(\$v->name, \$v->validate);
            }
            \$validator = Validator::make(\$request->all(), \$rules->all());
            if (\$validator->fails()) {
                return redirect()
                    ->route('{$mould->table_name}.edit',['mid'=>\$request->get('mould_id'),'cid'=>\$request->get('category_id')])
                    ->withErrors(\$validator)
                    ->withInput();
            }
        }

        foreach (\$request->all() as \$k=>\$v){
            if (is_array(\$request->get(\$k))){
                \$request[\$k]=implode(',',\$request->get(\$k));
            }
        }
        if (\${$fileName}->update(\$request->except(['file','tags']))) {
            //保存标签
            if (\$request->get('tags') != null){
                \${$fileName}->syncTags(explode(',',\$request->get('tags')));
            }


            return redirect()->route('{$mould->table_name}.index',['id'=>\${$fileName}->id,'cid'=>\${$fileName}->category_id,'mid'=>\${$fileName}->mould_id])->with('successMsg', '文档更新成功!');
        }
        return back()->withInput()->withErrors('文档更新失败!');
    }


    /**
     * @param \$id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(\$id)
    {
        if ({$fileName}::destroy(explode(',',\$id))) {
            return \$this->sendSuccess("文档删除成功!");
        }
        return \$this->sendError("文档删除失败!");
    }

    /**
     * 获取自定义模型字段
     * @param \$id
     * @return mixed
     */
    private function getFieldsByMouldId(\$mid){
        return Field::where(['mould_id'=>\$mid,'is_system'=>false])->orderBy('order','DESC')->get();
    }

    //获取模型名称
    private function getMouldNameById(\$mid){
        return Mould::where('id',\$mid)->value('table_name');
    }
}
EOF;

            \File::put(app_path('Http/Controllers/Backend/'.$fileName.'Controller.php'),$result);
        }
        //创建模型
        $mould_class_name=$fileName;
        $mould_content=<<<EOF
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class $mould_class_name extends Model
{
    protected \$table='$mould->table_name';
    protected \$guarded = array();
    

    public function tags()
    {
        return \$this->belongsToMany(Tag::class, 'model_tag');
    }


    public function comments(){
        return \$this->hasMany(Comment::class);
    }

    /**
     * @param \$tags
     */
    public function syncTags(\$tags)
    {
        //先删除所关联的标签
        \$this->tags()->detach();
        if (\$tags != null && is_array(\$tags) && count(\$tags) > 0) {
            if (count(\$tags) > 0) {
                \$this->tags()->sync(
                    Tag::whereIn('id', \$tags)->pluck('id')
                );
                return;
            }
        }

    }
}
EOF;
        if (!\File::exists(app_path('Models/'.$fileName.'.php'))){
            \File::put(app_path('Models/'.$fileName.'.php'),$mould_content);
        }

        //创建后端视图
        if (!is_dir(resource_path('views/backend/'.$mould->table_name))){
            \File::makeDirectory(resource_path('views/backend/'.$mould->table_name));
        }
        //复制目录文件
        \File::copyDirectory(resource_path('views/backend/post'),resource_path('views/backend/'.$mould->table_name));

        //创建前端视图
        $view_list_content=<<<EOF
<!DOCTYPE html>
<html>
    <head>
        <title>自定义模板列表页</title>
    </head>
    <body>
        这是一个自定义模板列表页，请根据需求添加合适的模板列表。
    </body>
</html>
EOF;
        $view_content=<<<EOF
<!DOCTYPE html>
<html>
    <head>
        <title>自定义模板详情页</title>
    </head>
    <body>
        这是一个自定义模板详情页，请根据需求添加合适的模板详情。
    </body>
</html>
EOF;

        if (!\File::exists(resource_path('views/frontend/list_'.$mould->table_name.'.blade.php'))){
            \File::put(resource_path('views/frontend/list_'.$mould->table_name.'.blade.php'),$view_list_content);
        }

        if (!\File::exists(resource_path('views/frontend/view_'.$mould->table_name.'.blade.php'))){
            \File::put(resource_path('views/frontend/view_'.$mould->table_name.'.blade.php'),$view_content);
        }
    }
}
