@extends('backend.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body">
                <table class="layui-hide" id="app-data-table" lay-filter="app-data-table"></table>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        layui.use(['table','jquery'], function () {
            var table = layui.table;
            var $ = layui.$;

            table.render({
                elem: '#app-data-table',
                toolbar: '#app-data-table-tool-bar',
                title: '用户数据表',
                cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', title: 'ID', width: 80, fixed: 'left', unresize: true, sort: true}
                    , {field: 'operator', title: '操作员',width: 120}
                    , {field: 'url', title: '操作类型',width: 150}
                    , {field: 'description', title: '描述',}
                    , {field: 'operate_ip', title: 'IP',width: 150}
                    , {field: 'operate_time', title: '操作时间', sort: true,width: 200}
                ]],
                data:@json($logs),
                page: true,
                toolbar:false,
                limit:20,
                limits:[20,40,60,80,100,120],
                loading:true
            });
        });
    </script>
@stop
