@extends('backend.layout')
@section('css')
    <style>
        .td_active{color: red;}
    </style>
    @endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row pb-3">
                    <div class="col-lg-8">

                    </div>
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{route('role.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加角色</a>
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
                            <th>描述</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($roles) > 0)
                            @foreach($roles as $v)
                                <tr class="{{$v->name == 'admin' ? 'td_active' : ''}}">
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>{{$v->display_name}}</td>
                                    <td>{{$v->description}}</td>
                                    <td class="table_tools">

                                        <a href="{{route('role.edit',$v->id)}}"
                                           class="btn btn-outline-info waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                class="fa fa-edit"></i> 编辑</a>

                                        @if($v->name != 'admin')
                                        <a href="javascript:;"
                                           onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                           class="btn btn-outline-danger waves-effect waves-light btn-sm btn-rounded"><i
                                                class="fa fa-trash"></i> 删除</a>
                                        @endif

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

@stop
@section('script')
    <script>

    </script>
@stop
