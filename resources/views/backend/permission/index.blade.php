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
                            <a href="{{route('permission.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加权限</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>名称</th>
                            <th>别名</th>
                            <th>路由</th>
                            <th>看护者</th>
                            <th>所属栏目</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($permissions) > 0)
                            @foreach($permissions as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->display_name}}</td>
                                    <td>{{$v->url}}</td>
                                    <td>{{$v->guard_name}}</td>
                                    <td>{{$v->menu->title}}</td>
                                    <td class="table_tools">
                                        <a href="{{route('permission.edit',$v->id)}}"
                                           class="btn btn-outline-info waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:;"
                                           onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                           class="btn btn-outline-danger waves-effect waves-light btn-sm btn-rounded"><i
                                                class="fa fa-trash"></i> 删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="7" class="text-danger text-center">暂无数据</td>
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
