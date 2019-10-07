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
                            <a href="{{route('mould.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加模型</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>模型名称</th>
                            <th>描述</th>
                            <th>表名</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($moulds->count())
                            @foreach($moulds as $v)
                                <tr>
                                    <td><b>{{$v->id}}</b></td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->des}}</td>
                                    <td>{{$v->table_name}}</td>
                                    <td>
                                        <span
                                            class="badge {{$v->status === 1 ? 'badge-light-primary' : 'badge-light-warning'}}">{{$v->status === 1 ? '启用' : '禁用'}}</span>
                                    </td>
                                    <td class="table_tools">
                                        <a href="{{url('/admin/field?mid='.$v->id)}}"
                                           class="btn btn-outline-warning waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                class="ti-harddrives"></i> 字段管理</a>
                                            <a href="{{route('mould.edit',$v->id)}}"
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
                            <td colspan="6" class="text-danger text-center">暂无数据</td>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>

    </script>
@stop
