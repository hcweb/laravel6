@extends('backend.layout')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-md-12">
            <div class="card code-table">
                <div class="card-body">
                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show">
                        　　备份数据库可能需要花费较长时间，取决于你的数据库已用空间。备份成功后，请点击下载所需要的备份文件，下载完后，为了安全起见，一定要点击下方删除按钮删除备份文件！
                    </div>
                    <button class="btn btn-secondary shadow-2 btn-rounded" id="data_backup" style="margin: 50px auto;display: block;">
                        <i class="fa fa-recycle"></i>
                        <span>开始备份数据库</span>
                    </button>
                </div>

                @if(count($fileInfos) > 0)
                    <h3>历史备份记录</h3>
                    <table class="layui-table">
                        <colgroup>
                            <col width="150">
                            <col width="200">
                            <col>
                        </colgroup>
                        <thead>
                        <tr>
                            <th>文件名称</th>
                            <th width="15%">文件大小</th>
                            <th width="15%">备份日期</th>
                            <th width="15%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($fileInfos as $v)
                            <tr class="unread">
                                <td>{{$v['name']}}</td>
                                <td>{{format_bytes($v['size'])}}</td>
                                <td>{{date('Y-m-d H:i:s',$v['date'])}}</td>
                                <td class="table_tools">
                                    <a href="{{route('database.down',['file'=>$v['name']])}}"
                                       class="layui-btn layui-btn-xs"
                                    ><i
                                            class="fa fa-download" style="font-size: 12px !important;"></i> 下载
                                    </a>
                                    <button data-url="database/restore/{{$v['name']}}"
                                            class="layui-btn layui-btn-warm layui-btn-xs app-database-btn"><i
                                            class="fa fa-refresh" style="font-size: 12px !important;"></i> 还原
                                    </button>
                                    <button data-url="database/delete/{{$v['name']}}"
                                            class="layui-btn layui-btn-danger layui-btn-xs app-database-btn"
                                    ><i class="fa fa-trash"></i> 删除
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>




@stop
@section('script')
    <script>
        $('#data_backup').click(function () {
            $(this).attr('disabled', true);
            $(this).find('span').text('备份中,请不要刷新网页！');
            $.get("{{route('database.backup')}}")
                .success(function (response) {
                    console.log(response);
                    if (response.code == 1) {
                        layer.msg(response.msg, {icon: 6});
                    } else {
                        layer.msg(response.msg, {icon: 5});
                    }
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1000);
                })
                .error(function (response) {
                    layer.msg('数据库备份失败！', {icon: 5});
                });
        });


        $('.app-database-btn').click(function () {
            $(this).attr('disabled', true);
            var url = $(this).data('url');
            $.get(url)
                .success(function (response) {
                    if (response.code == 1) {
                        layer.msg(response.msg, {icon: 6});
                    } else {
                        layer.msg(response.msg, {icon: 5});
                    }
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1000);
                })
                .error(function (response) {
                    layer.msg('操作失败！', {icon: 5});
                });
        });
    </script>
@stop
