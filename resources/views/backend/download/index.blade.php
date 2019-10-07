@extends('backend.layout')
@section('content')

        <div class="layui-card">
            <div class="layui-card-body">
                <table class="layui-hide" id="app-data-table" lay-filter="app-data-table"></table>
                <script type="text/html" id="app-data-table-tool-bar">
                    <div class="layui-btn-container">
                        <a class="layui-btn" href="{{route($mould_name.'.create',['mid'=>request('mid'),'cid'=>request('cid')])}}"><i
                                class="layui-icon">&#xe608;</i> 添加文档
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

@stop
@section('script')
    @include('backend.common._ifram')
    <script>
        layui.use(['table', 'jquery','layer'], function () {
            var table = layui.table;
            var $ = layui.$;
            var layer = layui.layer;


            var dataTable=table.render({
                elem: '#app-data-table',
                toolbar: '#app-data-table-tool-bar',
                title: '后台菜单表',
                cols: [[
                    {type: 'checkbox', fixed: 'left'}
                    , {field: 'title',title: '标题',templet:function (res) {
                           // var fontStyle=res.font_style;
                           // var result=parseInt(fontStyle.split(','));
                           // var styleHtml='';
                           // if (result[0] == 1){
                           //     styleHtml+='';
                           // }
                            if (res.thumb != null){
                                return '<i class="fa fa-image img-tip" data-src="'+res.thumb+'" style="color: #009688;margin-right: 10px;"></i>'+'<a href="#" style="color:#009688">'+res.title+'</a>';
                            }
                            return '<a href="#" style="color:#009688">'+res.title+'</a>';
                        }}
                    , {field: 'category_id', width: 100,title: '所属栏目',templet:function (res) {
                            return res.category.title;
                        }}
                    , {field: 'views', width: 80,title: '浏览量'}
                    , {field: 'created_at', width: 150,title: '更新时间'}
                    , {fixed: 'right', title: '操作', toolbar: '#app-data-table-bar', width: 150}
                ]],
                data:@json($post_data),
                page: true,
                limit:10,
                limits:[10,20,30,40,50,60,80,90,100,110,120,130,140,150,200,300,400,500],
                defaultToolbar:['filter']
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
                                    window.location.href=window.location.href;
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
                    location.href = '/admin/{{$mould_name}}/'+data.id+'/edit?mid={{request('mid')}}&cid={{request('cid')}}';
                }
            });

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
