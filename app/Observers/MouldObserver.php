<?php

namespace App\Observers;

use App\Models\Field;
use App\Models\Mould;
use Illuminate\Support\Str;

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
//            ['title'=>'创建时间','mould_id'=>$mould->id,'name'=>'created_at','is_system'=>true,'type'=>'datetime'],
//            ['title'=>'更新时间','mould_id'=>$mould->id,'name'=>'updated_at','is_system'=>true,'type'=>'datetime']
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

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class {$fileName}Controller extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \$tags = Tag::all();
        return view('backend.tag.index', compact('tags'));
    }


    /**
     * @param TagRequest \$request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TagRequest \$request)
    {
        if (Tag::create(\$request->all())) {
            return \$this->sendSuccess('标签添加成功!');
        }
        return \$this->sendError('标签添加失败!');
    }


    /**
     * @param TagRequest \$request
     * @param \$id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TagRequest \$request, \$id)
    {
        \$tag = \$this->findById(\$id);
        if (\$tag->update(\$request->all())) {
            return \$this->sendSuccess('标签更新成功!');
        }
        return \$this->sendError('标签更新失败!');
    }

    /**
     * @param \$id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(\$id)
    {
        if (Tag::destroy(explode(',', \$id))) {
            return \$this->sendSuccess("标签删除成功!");
        }
        return \$this->sendError("标签删除失败!");
    }

    /**
     * @param \$id
     * @return mixed
     */
    protected function findById(\$id)
    {
        return Tag::findOrFail(\$id);
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
