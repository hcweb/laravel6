@extends('backend.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row pb-3">
                    <div class="col-lg-8">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="inputPassword2" class="sr-only">Search</label>
                                <input type="search" class="form-control" id="inputPassword2" placeholder="请输入关键字进行查询...">
                            </div>
                            <div class="form-group mx-sm-3">
                                <label for="status-select" class="mr-2">Sort By</label>
                                <select class="custom-select" id="status-select">
                                    <option selected="">All</option>
                                    <option value="1">Date</option>
                                    <option value="2">Name</option>
                                    <option value="3">Revenue</option>
                                    <option value="4">Employees</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{route('user.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加用戶</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>邮箱</th>
                        <th>图像</th>
                        <th>姓名</th>
                        <th>角色</th>
                        <th>状态</th>
                        <th>IP</th>
                        <th>加入时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($users) > 0)
                        @foreach($users as $v)
                            <tr>
                                <td>{{$v->id}}</td>
                                <td>{{$v->name}}</td>
                                <td>{{$v->email}}</td>
                                <td><img src="{{$v->avatar}}" alt="" width="100px;" class="avatar-sm rounded-circle img-thumbnail"></td>
                                <td>{{$v->real_name}}</td>
                                <td>
                                    @foreach($v->roles as $role)
                                        {{$role->display_name}}
                                    @endforeach
                                </td>
                                <td>
                                    <span
                                        class="badge {{$v->is_enabled === 1 ? 'badge-light-primary' : 'badge-light-warning'}}">{{$v->is_enabled === 1 ? '启用' : '禁用'}}</span>
                                </td>
                                <td>{{$v->ip}}</td>
                                <td>{{$v->created_at}}</td>
                                <td class="table_tools">
                                    <a href="{{route('user.edit',$v->id)}}"
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
                        <td colspan="10" class="text-danger text-center">暂无数据</td>
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
