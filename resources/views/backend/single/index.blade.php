@extends('backend.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body">
                <table class="layui-hide" id="app-data-table" lay-filter="app-data-table"></table>
                <script type="text/html" id="app-data-table-tool-bar">
                    <div class="layui-btn-container">
                        <a class="layui-btn" href="{{route('category.create')}}"><i
                                class="layui-icon">&#xe608;</i> 添加前台菜单
                        </a>
                        <div class="layui-btn-group">
                            <button class="layui-btn layui-btn-primary" lay-event="choseAll">
                                <i class="fa fa-check"></i>
                                全选
                            </button>
                            <button class="layui-btn layui-btn-primary" lay-event="delAll">
                                <i class="fa fa-trash"></i>
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
        layui.use(['table', 'jquery'], function () {
            var table = layui.table;
            var $ = layui.$;


            var dataTable=table.render({
                elem: '#app-data-table',
                toolbar: '#app-data-table-tool-bar',
                title: '前台菜单表',
                cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'id', title: 'ID', width: 80, fixed: 'left', unresize: true, sort: true}
                    , {field: 'icon_class',width: 80, title: '图标',templet:function (res) {
                            return '<i class="'+res.icon_class+'"></i>'
                        }}
                    , {field: 'title',title: '标题',templet:function (res) {
                            var  re='---';
                            return '<span style="display:inline-block;width:'+res.depth*15+'px"></span>'+'<i class="fa fa-folder-open" style="color:#999;margin-right:5px;"></i>'+res.title+'<a href="category/create?id='+res.id+'&mid='+res.mould.id+'"><i class="fa fa-plus-circle" style="margin-left: 5px;" title="添加子级"></i></a>';
                        }}
                    , {field: 'target',width: 120, title: '打开方式',templet:function (res) {
                            switch (res.target) {
                                case '_self':
                                    return '本页打开';
                                    break;
                                case '_blank':
                                    return '新窗体中打开';
                                    break;
                                case '_parent':
                                    return '父窗体中打开';
                                    break;
                            }
                        }}
                    , {field: 'name',width: 150, title: '所属类型',templet:function (res) {
                            return res.mould.name;
                        }}
                    , {field: 'is_show',width: 120, title: '显示状态',templet:function (res) {
                            var html = '';
                            if (res.is_show == 1) {
                                html = '<div class="layui-input-block" style="margin-left: 0">' +
                                    '<input type="checkbox" name="switch"  lay-skin="switch" lay-text="显示|隐藏" checked disabled>' +
                                    '</div>';
                            } else {
                                html = '<div class="layui-input-block" style="margin-left: 0">' +
                                    '<input type="checkbox" name="switch"  lay-skin="switch" lay-text="显示|隐藏" disabled>' +
                                    '</div>';
                            }
                            return html;
                        }}
                    , {field: 'color',width: 120, title: '字体颜色',templet:function (res) {
                            return '<i style="width:10px;height: 10px;display: inline-block;border-radius: 100px;background: '+res.color+'"></i>';
                        }}
                    , {fixed: 'right', title: '操作', toolbar: '#app-data-table-bar', width: 150}
                ]],
                data:@json($categorys),
                page: false,
                defaultToolbar:['filter'],
                limit:{{count($categorys)}}
            });

            //头工具栏事件
            table.on('toolbar(app-data-table)', function (obj) {
                var ids = [];
                var checkStatus = table.checkStatus(obj.config.id);
                var hasCheckData = checkStatus.data;
                switch (obj.event) {
                    case 'choseAll':
                        $('input[name=checkbox]').prop('checked', true);
                        break;
                    case 'delAll':
                        if (hasCheckData.length > 0) {
                            $.each(hasCheckData, function (index, element) {
                                ids.push(element.id)
                            })
                        }

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
                                   // window.location.href=window.location.href;
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
                    location.href = '/admin/category/' + data.id + '/edit';
                }
            });
        });
    </script>
@stop
