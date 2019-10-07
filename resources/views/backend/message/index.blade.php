@extends('backend.layout')
@section('css')
    <style>
        table{border: none;}
        .layui-table-cell{height: auto;white-space: normal;}
        .message_box{position: relative;padding-left: 80px;}
        .message_box img{position: absolute;width: 60px;height: 60px;border-radius: 100px;left: 0;top: 0;}
        .layui-table-box{border: none;}
        .layui-table-header{display: none;}
        table tr{border-bottom: 1px solid #e6e6e6;}
    </style>
@stop
@section('content')
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body">
                <table class="layui-hide" lay-skin="nob" id="app-data-table" lay-filter="app-data-table"></table>
                {{--<script type="text/html" id="app-data-table-tool-bar">--}}
                    {{--<div class="layui-btn-container">--}}
                        {{--<div class="layui-btn-group">--}}
                            {{--<button class="layui-btn layui-btn-primary" lay-event="choseAll">--}}
                                {{--<i class="fa fa-check"></i>--}}
                                {{--全选--}}
                            {{--</button>--}}
                            {{--<button class="layui-btn layui-btn-primary" lay-event="delAll">--}}

                                {{--<i class="fa fa-trash"></i>--}}
                                {{--批量删除--}}
                            {{--</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</script>--}}
                <script type="text/html" id="app-data-table-bar">
                    <a class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>审核</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                            class="layui-icon">&#xe640;</i>删除</a>
                </script>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        layui.use(['table', 'jquery'], function () {
            var table = layui.table;
            var $ = layui.$;


            var dataTable=table.render({
                elem: '#app-data-table',
                title: '留言数据表',
                cols: [[
                    {field: 'name', title: '内容',templet:function (res) {
                            console.log(res);
                            return '<div class="message_box">' +
                                   '<p><strong>'+res.member.name+'</strong><i style="margin-left:30px;">'+res.created_at+'</i></p>'+
                                   '<p><label style="color:#999999;">手机号 : </label>'+res.phone+'</p>'+
                                   '<p><label style="color:#999999;">邮箱 : </label>'+res.email+'</p>'+
                                   '<p><label style="color:#999999;">城市 : </label>'+res.city+'</p>'+
                                   '<p><label style="color:#999999;">标题 : </label>'+res.name+'</p>'+
                                   '<p><label style="color:#999999;">内容 : </label>'+res.content+'</p>' +
                                    '<img src="'+res.member.avatar+'"/>'+
                                   '</div>';
                        }}
                    , {fixed: 'right', title: '操作', toolbar: '#app-data-table-bar', width: 150}
                ]],
                data:@json($messages),
                page: true,
                skin:'nob',
                limit:10,
                limits:[10,20,30,40,50,60,80,90,100,110,120,130,140,150,200,300,400,500],
                defaultToolbar:[]
            });


            //监听行工具事件
            table.on('tool(app-data-table)', function (obj) {
                var data = obj.data;
                //console.log(obj)
                if (obj.event === 'del') {
                    layer.confirm('确定删除吗？删除后将无法恢复！', {
                        title: false,
                        icon: 7,
                    }, function (index) {
                        var url = '{{ URL::current() }}' + '/' + data.id;
                        $.post(url, {
                            _token: "{{csrf_token()}}",
                            _method: 'DELETE'
                        }).success(function (response) {
                            if (response.code == 1) {
                                obj.del();
                                layer.msg(response.msg, {icon: 6});
                            } else {
                                layer.msg(response.msg, {icon: 5});
                            }
                            layer.close(index);
                        })
                            .error(function () {
                                layer.close(index);
                                layer.msg('删除失败！', {icon: 5});
                            });
                    });
                } else if (obj.event === 'edit') {
                    location.href = '/admin/message/' + data.id + '/edit';
                }
            });
        });
    </script>
@stop
