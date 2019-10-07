@extends('backend.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body">
                <table class="layui-hide" id="app-data-table" lay-filter="app-data-table"></table>
                <script type="text/html" id="app-data-table-tool-bar">
                    <div class="layui-btn-container">
                        <a class="layui-btn" href="{{route('member.create')}}"><i
                                class="layui-icon">&#xe608;</i> 添加会员
                        </a>
                        <div class="layui-btn-group">
                            <button class="layui-btn layui-btn-primary" lay-event="choseAll">
                                <i class="layui-icon">&#xe654;</i>
                                全选
                            </button>
                            <button class="layui-btn layui-btn-primary" lay-event="delAll">
                                <i class="layui-icon">&#xe640;</i>
                                批量删除
                            </button>
                        </div>
                    </div>
                </script>
                <script type="text/html" id="app-data-table-bar">
                    <a class="layui-btn layui-btn-xs" lay-event="edit"><i class="layui-icon">&#xe642;</i>编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i
                            class="layui-icon">&#xe640;</i>删除</a>
                </script>
            </div>
        </div>
    </div>

@stop
@section('script')
    <script>
        layui.use(['table','jquery','form'], function () {
            var table = layui.table;
            var $ = layui.$;
            var form=layui.form;

            table.render({
                elem: '#app-data-table',
                toolbar: '#app-data-table-tool-bar',
                title: '会员数据表',
                cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', title: 'ID', width: 80, fixed: 'left', unresize: true, sort: true}
                    , {field: 'name', title: '用户名'}
                    , {field: 'city', title: '城市'}
                    , {field: 'email', title: '邮箱'}
                    , {
                        field: 'platform', title: '来源', templet: function (res) {
                            if (res.platform == 'github'){
                                return '<i class="fa fa-github"></i>'
                            }else if(res.platform == 'qq'){
                                return '<i class="fa fa-qq"></i>'
                            }else {
                                return ''
                            }

                        }
                    }
                    , {
                        field: 'avatar', title: '图像', templet: function (res) {
                            if (res.avatar == null){
                                res.avatar="{{asset('backend/images/default.jpg')}}";
                            }
                            return '<img class="layui-circle" style="width:28px;height: 28px;" src="' + res.avatar + '"/>'
                        }
                    }
                    , {
                        field: 'is_enabled', title: '状态', templet: function (res) {
                            var html = '';
                            if (res.is_enabled == 1) {
                                html = '<div class="layui-input-block" style="margin-left: 0">' +
                                    '<input type="checkbox" name="switch"  lay-skin="switch" lay-text="启用|禁用" checked disabled>' +
                                    '</div>';
                            } else {
                                html = '<div class="layui-input-block" style="margin-left: 0">' +
                                    '<input type="checkbox" name="switch"  lay-skin="switch" lay-text="启用|禁用" disabled>' +
                                    '</div>';
                            }
                            return html;
                        }
                    }
                    , {field: 'ip', title: 'IP',}
                    , {field: 'created_at', title: '加入时间', sort: true}
                    , {fixed: 'right', title: '操作', toolbar: '#app-data-table-bar', width: 150}
                ]],
                data:@json($members),
                page: false
            });

            //头工具栏事件
            table.on('toolbar(app-data-table)', function (obj) {
                var ids = [];
                var checkStatus = table.checkStatus(obj.config.id);
                var hasCheckData = checkStatus.data;
                switch (obj.event) {
                    case 'choseAll':
                        $("input[name=layTableCheckbox]").trigger("click");
                        // form.render('checkbox');
                        break;
                    case 'delAll':
                        if (hasCheckData.length > 0) {
                            $.each(hasCheckData, function (index, element) {
                                ids.push(element.id)
                            })
                        }
                        alert(ids);
                        if (ids.length > 0) {
                            layer.confirm('确定删除吗？删除后将无法恢复！', {
                                title: false,
                                icon: 7,
                            }, function (index) {
                                var url = '{{ URL::current() }}' + '/' + ids;
                                $.post(url, {
                                    _token: "{{csrf_token()}}",
                                    _method: 'DELETE'
                                }).success(function (response) {
                                    if (response.code == 1) {
                                        dataTable.reload();
                                        layer.msg(response.msg, {icon: 6});
                                    } else {
                                        layer.msg(response.msg, {icon: 5});
                                    }
                                    layer.close(index);
                                    //window.location.href=window.location.href;
                                })
                                    .error(function () {
                                        layer.close(index);
                                        layer.msg('删除失败！', {icon: 5});
                                    });
                            });
                        } else {
                            layer.msg('请选择要删除项', {icon: 5})
                        }
                        break;
                }
                ;
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
                            //window.location.href=window.location.href;
                        })
                            .error(function () {
                                layer.close(index);
                                layer.msg('删除失败！', {icon: 5});
                            });
                    });
                } else if (obj.event === 'edit') {
                    location.href = '/admin/member/' + data.id + '/edit';
                }
            });
        });
    </script>
@stop
