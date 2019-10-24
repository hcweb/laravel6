@extends('backend.m_layout')
@section('content')

                <div class="row pb-3">
                    <div class="col-8">
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
                    <div class="col-4">
                        <div class="text-right">
                            <a href="{{route($mould_name.'.create',['mid'=>request('mid'),'cid'=>request('cid')])}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加文档</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>所属栏目</th>
                            <th>浏览量</th>
                            <th>更新时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($post_data) > 0)
                            @foreach($post_data as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>
                                        @if(!is_null($v->thumb))
                                            <i class="fa fa-image img-tip" data-src="{{$v->thumb}}" style="color: #1abc9c;margin-right: 5px;"></i>
                                        @endif
                                        {{$v->title}}
                                    </td>
                                    <td>{{$v->category->title}}</td>
                                    <td>{{$v->views}}</td>
                                    <td>{{$v->created_at}}</td>
                                    <td class="table_tools">
                                        <a href="/admin/{{$mould_name}}/{{$v->id}}/edit?mid={{request('mid')}}&cid={{request('cid')}}"
                                           class="btn btn-outline-info waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                class="fa fa-edit"></i> 编辑</a>
                                        <a href="javascript:;"
                                           onclick="parent.i_delete('{{url()->current()}}','{{$v->id}}')"
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
                   <div class="text-center">
                       {{ $post_data->appends(['mid' => request('mid'),'cid'=>request('cid')])->links() }}
                   </div>
                </div>

@stop
@section('script')
    @include('backend.common._ifram')
    <script>
        $(function () {
            $('.img-tip').on({
                mouseenter:function(){
                    if ($(this).data('src') != ''){
                        tips =layer.tips("<img style='width:120px;' src='"+$(this).data('src')+"'/>",$(this),{tips:[3,'#ffffff'],time:0,area: 'auto',maxWidth:150,tipsMore:true});
                    }

                },
                mouseleave:function(){
                    layer.close(tips);
                }
            });
        });
    </script>
@stop
