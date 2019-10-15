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
                                <input type="search" class="form-control" id="inputPassword2" placeholder="请输入名称关键字查询...">
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{route('sellertype.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                               ><i class="mdi mdi-plus-circle mr-1"></i> 添加商家行业</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>排序</th>
                            <th>名称</th>
                            <th>图标</th>
                            <th>显示状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($sellerTypeTree) > 0)
                                @foreach($sellerTypeTree as $v)
                                    <tr>
                                        <td>{{$v->id}}</td>
                                        <td>
                                            <input type="text" value="{{$v->order_num}}" name="order_num"
                                                   class="form-control text-center" style="width: 60px;"
                                                   onblur="app.order('{{route('sellertype.order')}}',this.value,{{$v->id}})">
                                        </td>
                                        <td>
                                            <span style="margin-left:{{$v->depth*20}}px;display: inline-block;"></span>
                                            <span style="color: #999;">
                                                <i class="fa fa-folder-open"></i>
                                                {{--<span>{{str_repeat('-',$v->depth*3)}}</span>--}}
                                            </span>
                                            {{$v->name}}
                                            <a href="{{route('sellertype.create',['id'=>$v->id])}}" title="添加子级"><i
                                                    class="fa fa-plus-circle text-dark" aria-hidden="true"></i></a>
                                        </td>
                                        <td><i class="{{$v->icon}}"></i></td>
                                        <td>
                                            <span
                                                class="badge {{$v->is_show === 1 ? 'badge-light-primary' : 'badge-light-warning'}}">{{$v->is_show === 1 ? '显示' : '隐藏'}}</span>
                                        </td>

                                        @canany('sellertype_edit','sellertype_destroy')
                                            <td class="table_tools">

                                                @can('sellertype_edit')
                                                    <a href="{{url('admin/sellertype/'.$v->id.'/edit')}}"
                                                       class="btn btn-outline-info waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                            class="fa fa-edit"></i> 编辑</a>
                                                @endcan
                                                @can('sellertype_destroy')
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
                                <td colspan="6" class="text-danger text-center">暂无数据</td>
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
