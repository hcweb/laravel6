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
                    @can('category_create')
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{route('category.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加栏目</a>
                        </div>
                    </div><!-- end col-->
                        @endcan
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>排序</th>
                            <th>图标</th>
                            <th>标题</th>
                            <th>打开方式</th>
                            <th>所属类型</th>
                            <th>显示状态</th>
                            <th>字体颜色</th>
                            @canany('category_edit','category_destroy','content_create')
                            <th>操作</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($categorys) > 0)
                            @foreach($categorys as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>
                                        <input type="text" value="{{$v->order}}" name="order"
                                               class="form-control text-center" style="width: 60px;"
                                               onblur="app.order('{{route('category.order')}}',this.value,{{$v->id}})">
                                    </td>
                                    <td><i class="{{$v->icon_class}}"></i></td>
                                    <td>
                                        <span style="margin-left:{{$v->depth*20}}px;display: inline-block;"></span>
                                        <span style="color: #999;">
                                        <i class="fa fa-folder-open"></i>
                                        {{--<span>{{str_repeat('-',$v->depth*3)}}</span>--}}
                                    </span>
                                        {{$v->title}}
                                        <a href="{{route('category.create',['id'=>$v->id])}}" title="添加子级"><i
                                                class="fa fa-plus-circle text-dark" aria-hidden="true"></i></a>
                                    </td>
                                    <td>
                                        @switch($v->target)
                                            @case('_self')
                                            本页打开
                                            @break
                                            @case('_blank')
                                            新窗体中打开
                                            @break
                                            @case('_parent')
                                            父窗体中打开
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{$v->mould->name}}</td>
                                    <td>
                                            <span
                                                class="badge {{$v->is_show === 1 ? 'badge-light-primary' : 'badge-light-warning'}}">{{$v->is_show === 1 ? '显示' : '隐藏'}}</span>
                                    </td>
                                    <td><i style="width:10px;height: 10px;display: inline-block;border-radius: 100px;background: {{$v->color}}"></i></td>
                                    @canany('category_edit','category_destroy','content_create')
                                    <td class="table_tools">

                                        <a href="{{url('admin/category/'.$v->id.'/edit')}}"
                                           class="btn btn-outline-warning waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                class="fa fa-file"></i> 添加内容</a>

                                        @can('category_edit')
                                        <a href="{{url('admin/category/'.$v->id.'/edit')}}"
                                           class="btn btn-outline-info waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                class="fa fa-edit"></i> 编辑</a>
                                            @endcan
                                            @can('category_destroy')
                                        <a href="javascript:;"
                                           onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                           class="btn btn-outline-danger waves-effect waves-light btn-sm btn-rounded"><i
                                                class="fa fa-trash"></i> 删除</a>
                                                @endcan
                                    </td>
                                        @endcanany
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    23
                                </td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
