<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\MouldRequest;
use App\Jobs\MouldCommentJob;
use App\Models\Mould;
use Illuminate\Support\Str;

class MouldController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $moulds = Mould::all();
        return view('backend.mould.index', compact('moulds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$tables=getListTableNames();
        return view('backend.mould.create');
    }


    /**
     * @param MouldRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(MouldRequest $request)
    {
        $tableName = trim($request->get('table_name'));
        //如果表已经存在
        if (!\Schema::hasTable($tableName)) {
            $result = \DB::transaction(function () use ($request, $tableName) {
                    //控制器名称
                    $ctr_name=Str::studly($request->get('table_name'));
                    $model=Mould::create(array_merge($request->all(),['ctr_name'=>$ctr_name.'Controller']));
                    if ($model){
                        MouldCommentJob::dispatch();
                    }

                    \Schema::create($tableName, function ($table) use ($tableName) {
                        $table->increments('id');
                        $table->integer('category_id')->unsigned()->comment('所属分类id');
                        $table->integer('mould_id')->unsigned()->comment('所属模型id');
                        $table->string('title')->unique()->comment('文章标题');
                        $table->string('alias')->unique()->comment('文章别名');
                        $table->boolean('is_show')->default(true)->nullable()->comment('是否发布');
                        $table->boolean('is_comment')->default(false)->nullable()->comment('允许评论');
                        $table->boolean('is_top')->default(false)->nullable()->comment('推荐类型 置顶');
                        $table->boolean('is_hot')->default(false)->nullable()->comment('推荐类型 热门');
                        $table->boolean('is_tuijian')->default(false)->nullable()->comment('推荐类型 推荐');
                        $table->boolean('is_slide')->default(false)->nullable()->comment('推荐类型 幻灯片');
                        $table->string('thumb')->nullable()->comment('封面图片');
                        $table->string('font_style',5)->nullable()->comment('字体样式 b加粗 i倾斜');
                        $table->string('color',10)->nullable()->comment('字体颜色');
                        $table->integer('order')->unsigned()->nullable()->default(0)->comment('排序');
                        $table->integer('views')->unsigned()->nullable()->default(0)->comment('浏览次数');
                        $table->timestamp('push_time')->nullable()->comment('发布时间');
                        $table->string('url')->nullable()->comment('URL链接');
                        $table->string('source', 50)->default('本站')->nullable()->comment('信息来源');
                        $table->string('author', 50)->default('管理员')->nullable()->comment('文章作者');
                        $table->string('summary')->nullable()->comment('内容摘要');
                        $table->text('description')->nullable()->comment('内容描述');
                        $table->string('seo_title', 255)->nullable()->comment('SEO标题');
                        $table->string('seo_key', 255)->nullable()->comment('SEO关健字');
                        $table->string('seo_content', 255)->nullable()->comment('SEO描述');
                        $table->foreign('category_id')
                            ->references('id')
                            ->on('categorys')
                            ->onDelete('cascade');
                        $table->foreign('mould_id')
                            ->references('id')
                            ->on('moulds')
                            ->onDelete('cascade');
                        $table->timestamps();
                    });
            });
            if (is_null($result)) {
                return redirect()->route('mould.index')->with('successMsg', '模型添加成功!');
            }
            return back()->withInput()->withErrors('模型添加失败!');
        }
        return back()->withInput()->withErrors('模型标识已经存在,重新试试呗!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mould $mould
     * @return \Illuminate\Http\Response
     */
    public function show(Mould $mould)
    {
        //
    }

    /**
     * @param Mould $mould
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Mould $mould)
    {
        $tables=getListTableNames();
        return view('backend.mould.edit', compact('mould','tables'));
    }

    /**
     * @param MouldRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MouldRequest $request, $id)
    {
        $tableName = trim($request->get('table_name'));
        $mould = $this->findById($id);
        $oldTableName = trim($mould->table_name);
        //判断表是否存在
        //如果不存在的话,则重命名表
        if (!\Schema::hasTable($tableName)) {
            //更新表名称
            \Schema::rename($oldTableName, $tableName);
        }
        if ($mould->update($request->except('modelId'))) {
            return redirect()->route('mould.index')->with('successMsg', '模型更新成功!');
        } else {
            //如果更新失败，判断表是否更新成功
            if (\Schema::hasTable($tableName)) {
                \Schema::rename($tableName, $oldTableName);
            }
            return back()->withInput()->withErrors('模型更新失败!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $mould=$this->findById($id);
        if ($mould->delete()) {
            MouldCommentJob::dispatch();
            return $this->sendSuccess("模型删除成功!");
        }
        return $this->sendError("模型删除失败!");
    }


    /**
     * @param $id
     * @return mixed
     */
    protected function findById($id)
    {
        return Mould::findOrFail($id);
    }

    //获取模型名称
    public function getMouldNameById($mid){
        $mould=$this->findById($mid);
        if ($mould){
            return $this->sendSuccess("",$mould->table_name);
        }
        return $this->sendError("");
    }
}
