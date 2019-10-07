@extends('backend.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row pb-3">
                    <div class="col-lg-8">

                    </div>
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{route('field.create',['mid'=>request('mid')])}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加字段</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>标题</th>
                            <th>名称</th>
                            <th>类型</th>
                            <th>必填</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($fields->count())
                            @foreach($fields as $v)
                                <tr>
                                    <td>{{$v->title}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>
                                        @switch ($v->type)
                                        @case('text')
                                        单行文本
                                        @break
                                        @case('multitext')
                                        多行文本
                                        @break
                                        @case('htmltext')
                                        HTML文本
                                        @break
                                        @case('radio')
                                        单选项
                                        @break
                                        @case('checkbox')
                                        多选项
                                        @break
                                        @case('select')
                                        下拉框
                                        @break
                                        @case('int')
                                        整数类型
                                        @break
                                        @case('float')
                                        小数类型
                                        @break
                                        @case('decimal')
                                        金额类型
                                        @break
                                        @case('img')
                                        单张图
                                        @break
                                        @case('imgs')
                                        多张图
                                        @break
                                        @case('datetime')
                                        日期和时间
                                        @break
                                        @case('switch')
                                        开关
                                        @break
                                        @case('files')
                                        附件
                                        @break;
                                        @case('color')
                                        取色器
                                        @break;
                                        @endswitch
                                    </td>
                                    <td>
                                        @if ($v->is_empty == 0)
                                            <i class="ti-close" style="color: red;"></i>
                                             @else
                                            <i class="ti-check" style="color: green;"></i>
                                            @endif
                                    </td>
                                    <td class="table_tools">
                                        <a href="{{route('field.edit',[$v->id,'mid'=>$v->mould_id])}}"
                                           class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:;"
                                           onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                           class="btn btn-outline-danger waves-effect waves-light btn-sm btn-rounded"><i
                                                class="fa fa-trash"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="5" class="text-danger text-center">暂无数据</td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
