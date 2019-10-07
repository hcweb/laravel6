@extends('backend.layout')
@section('css')

@endsection
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
                            <a href="{{route('block.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加资料</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th class="font-weight-medium">ID</th>
                        <th class="font-weight-medium">名称</th>
                        <th class="font-weight-medium">类型</th>
                        <th class="font-weight-medium">调用方式</th>
                        <th class="font-weight-medium">操作</th>
                    </tr>
                    </thead>

                    <tbody class="font-14">
                    @if($blocks->count())
                        @foreach($blocks as $v)
                            <tr>
                                <td><b>{{$v->id}}</b></td>
                                <td>{{$v->title}}</td>
                                <td>
                                    @switch($v->type)
                                        @case('I')
                                        <span class="badge badge-info">图片</span>
                                        @break
                                        @case('E')
                                        <span class="badge badge-danger">编辑</span>
                                        @break
                                        @case('F')
                                        <span class="badge badge-pink">文字</span>
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    @php
                                        echo "{!! block($v->id) !!}";
                                    @endphp
                                </td>
                                <td class="text-right table_tools">
                                    @can('block_edit')
                                    <a href="{{url('admin/block/'.$v->id.'/edit')}}"
                                       class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                            class="fa fa-edit"></i> 编辑</a>
                                    @endcan
                                    <a href="javascript:;"
                                       onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                       class="btn btn-outline-danger waves-effect waves-light btn-sm btn-rounded"><i
                                            class="fa fa-trash"></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
@stop
@section('script')
    <script>

    </script>
@stop
