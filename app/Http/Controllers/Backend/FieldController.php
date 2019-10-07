<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\FieldRequest;
use App\Models\Field;
use App\Models\Mould;
use Illuminate\Http\Request;

class FieldController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fields=Field::where('mould_id',$request->get('mid'))
            ->where('is_system',false)
            ->orderBy('order','DESC')
            ->get();
        return view('backend.field.index',compact('fields'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.field.create');
    }

    /**
     * @param FieldRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(FieldRequest $request)
    {
        $result = \DB::transaction(function () use ($request) {
            $model = Mould::where('id', $request->get('mould_id'))->first();
            $tableName = $model->table_name;
            \Schema::table($tableName, function ($table) use ($request) {
                $fieldName = $request->get('name');
                $title = $request->get('title');
                $type = $request->get('type');
                switch ($type) {
                    case 'text':
                        $table->string($fieldName)->nullable()->comment($title);
                        break;
                    case 'multitext':
                        $table->text($fieldName)->nullable()->comment($title);
                        break;
                    case 'htmltext':
                        $table->longtext($fieldName)->nullable()->comment($title);
                        break;
                    case 'radio':
                        $table->tinyInteger($fieldName)->nullable()->comment($title);
                        break;
                    case 'checkbox':
                        $table->string($fieldName)->nullable()->comment($title);
                        break;
                    case 'select':
                        $table->string($fieldName)->nullable()->comment($title);
                        break;
                    case 'int':
                        $table->integer($fieldName)->nullable()->comment($title);
                        break;
                    case 'float':
                        $table->float($fieldName)->nullable()->comment($title);
                        break;
                    case 'decimal':
                        $table->decimal($fieldName)->nullable()->comment($title);
                        break;
                    case 'img':
                        $table->string($fieldName)->nullable()->comment($title);
                        break;
                    case 'imgs':
                        $table->text($fieldName)->nullable()->comment($title);
                        break;
                    case 'datetime':
                        $table->dateTime($fieldName)->nullable()->comment($title);
                        break;
                    case 'switch':
                        $table->tinyInteger($fieldName)->nullable()->comment($title);
                        break;
                    case 'files':
                        $table->text($fieldName)->nullable()->comment($title);
                        break;
                    case 'color':
                        $table->string($fieldName)->nullable()->comment($title);
                        break;
                }
            });
            Field::create($request->all());
        });
        if (is_null($result)) {
            return redirect()->route('field.index',['mid'=>$request->get('mould_id')])->with('successMsg', '字段创建成功!');
        }
        return back()->withInput()->withErrors('字段创建失败!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Field $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        return view('backend.field.edit', compact('field'));
    }

    /**
     * @param FieldRequest $request
     * @param Field $field
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update(FieldRequest $request, Field $field)
    {
        $result = \DB::transaction(function () use ($request, $field) {

            $model = Mould::where('id', $request->get('mould_id'))->first();
            $tableName = $model->table_name;
            //先修改表字段名称
            \Schema::table($tableName, function ($table) use ($request, $field) {
                $table->renameColumn($field->name, $request->get('name'));
            });
            //修改表字段
            \Schema::table($tableName, function ($table) use ($request, $field) {
                $fieldName = $request->get('name');
                $title = $request->get('title');
                $type = $request->get('type');

                switch ($type) {
                    case 'text':
                        $table->string($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'multitext':
                        $table->text($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'htmltext':
                        $table->longtext($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'radio':
                        $table->tinyInteger($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'checkbox':
                        $table->string($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'select':
                        $table->string($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'int':
                        $table->integer($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'float':
                        $table->float($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'decimal':
                        $table->decimal($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'img':
                        $table->string($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'imgs':
                        $table->text($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'datetime':
                        $table->dateTime($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'switch':
                        $table->tinyInteger($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'files':
                        $table->text($fieldName)->nullable()->change()->comment($title);
                        break;
                    case 'color':
                        $table->string($fieldName)->nullable()->change()->comment($title);
                        break;
                }
            });
            $field->update($request->except('fieldId'));
        });

        if (is_null($result)) {
            return redirect()->route('field.index',['mid'=>$request->get('mould_id')])->with('successMsg', '字段更新成功!');
        }
        return back()->withInput()->withErrors('字段更新失败!');
    }

    /**
     * @param Field $field
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function destroy(Field $field)
    {
        $result = \DB::transaction(function () use ($field) {
            $tableName = $field->mould->table_name;
            //删除字段
            $field->delete();
            //删除附加表字段
            if (\Schema::hasColumn($tableName, $field->name)) {
                \Schema::table($tableName, function ($table) use ($field) {
                    $table->dropColumn($field->name);
                });
            }
        });

        if (is_null($result)) {
            return $this->sendSuccess("字段删除成功!");
        }
        return $this->sendError("字段删除失败!");
    }

    /**
     * 根据模型id获取所有字段信息
     * @param $mould_id
     * @return mixed
     */
    protected function getFieldsByMouldId($mould_id){
        return Field::where('mould_id',$mould_id)->get();
    }
}
