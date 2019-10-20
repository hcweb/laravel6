@extends('backend.layout')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row pb-3">
                    <div class="col-lg-8">
                        <form class="form-inline" id="search_form" method="get" action="{{route('seller.index')}}">
                            <div class="form-group">
                                {!! Form::input('text','key',old('key'),['class'=>'form-control','placeholder'=>'请输入关键词','autocomplete'=>'off']) !!}
                                <a href="javascript:;" onclick="document:search_form.submit();" class="btn btn-secondary waves-effect waves-light btn-rounded">搜索</a>
                            </div>

                        </form>
                    </div>
                    @can('seller_create')
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="{{route('seller.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                               ><i class="mdi mdi-plus-circle mr-1"></i> 添加商家</a>
                        </div>
                    </div><!-- end col-->
                        @endcan
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%;">商家名称</th>
                            <th style="width: 5%;">状态</th>
                            <th style="width: 20%;">logo</th>
                            <th style="width: 15%;">注册时间</th>
                            <th style="width: 15%;">有效期</th>
                            <th style="width: 20%;">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($sellerList) > 0)
                            @foreach($sellerList as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>{{$v->name}}</td>
                                    <td>
                                            <span
                                                class="badge {{$v->valid === 1 ? 'badge-light-primary' : 'badge-light-warning'}}">{{$v->valid === 1 ? '有效' : '无效'}}</span>
                                    </td>
                                    <td>
                                        @if(!is_null($v->logo))
                                            <img src="{{$v->logo}}" alt="" style="width: 60px;">
                                        @endif
                                    </td>
                                    <td>{{$v->created_at}}</td>
                                    <td>{{$v->valid_time}}</td>

                                    @canany('seller_edit','seller_destroy')
                                        <td class="table_tools">

                                            @can('seller_edit')
                                                <a href="{{url('admin/seller/'.$v->id.'/edit')}}"
                                                   class="btn btn-outline-info waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                        class="fa fa-edit"></i> 编辑</a>
                                            @endcan
                                            @can('seller_destroy')
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
                <div class="pull-right">
                    {{$sellerList->appends(array('key'=>$key))->render()}}
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')

@endsection
