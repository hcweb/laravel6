@extends('backend.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/codemirror/css/monokai.css')}}">
    <link rel="stylesheet" href="{{asset('backend/plugins/codemirror/css/codemirror.css')}}">
@stop
@section('content')
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body">
                <p style="margin-bottom: 10px;">文件列表（共条{{(isset($data['dirs']['public_path']) ? count($data['dirs']['public_path']) : 0)+(isset($data['dirs']['resource_path']) ? count($data['dirs']['resource_path']) : 0)+(isset($data['files']['public_path']) ? count($data['files']['public_path']) : 0)+(isset($data['files']['resource_path']) ? count($data['files']['resource_path']) : 0)}}记录）</p>
                <table class="layui-table" style="margin: 0 auto;" lay-skin="nob">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th style="width: 5%">大小</th>
                        <th style="width: 5%">可读</th>
                        <th style="width: 5%">可写</th>
                        <th style="width: 15%">修改时间</th>
                        <th style="width: 150px;padding:0 15px;box-sizing:border-box">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (request()->get('path') == 'public_path' && request()->get('path') != '')
                            <tr>
                                <td colspan="6">
                                    <a href="javascript:history.go(-1);"><i class="fa fa-reply"></i>上级目录</a>(当前目录{{'public/frontend'.request()->get('dir')}})
                                </td>
                            </tr>
                        @elseif(request()->get('path') == 'resource_path' && request()->get('path') != '')
                        <tr>
                            <td colspan="6">
                                <a href="javascript:history.go(-1);"><i class="fa fa-reply"></i>上级目录</a>(当前目录{{'resources/views/frontend'.request()->get('dir')}})
                            </td>
                        </tr>
                    @endif
                    @if (isset($data['dirs']['public_path'])&&count($data['dirs']['public_path']) > 0)
                        @foreach($data['dirs']['public_path'] as $v)
                            <tr>
                                <td><a href="template?path=public_path&dir={{$p_path.'/'.basename($v)}}" style="color:#009688"><img src="{{asset('backend/file_icons/directory.png')}}" alt="" style="width: 18px;margin-right: 5px;">{{basename($v)}}</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                    @if (isset($data['dirs']['resource_path'])&&count($data['dirs']['resource_path']) > 0)
                        @foreach($data['dirs']['resource_path'] as $v)
                            <tr>
                                <td><a href="template?path=resource_path&dir={{$p_path.'/'.basename($v)}}" style="color:#009688"><img src="{{asset('backend/file_icons/directory.png')}}" alt="" style="width: 18px;margin-right: 5px;">{{basename($v)}}</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    @endif
                    @if (isset($data['files']['public_path'])&&count($data['files']['public_path']) > 0)
                        @foreach($data['files']['public_path'] as $v)
                            <tr>
                                <td>
                                    <a href="#" style="color:#009688">
                                        @if (in_array(getFileExtension(basename($v)),['jpg','png','gif','jpeg','bmp']))
                                            <img src="{{asset('backend/file_icons/image.png')}}" alt="" style="width: 18px;margin-right: 5px;" onerror="javascript:this.src='{{asset('backend/file_icons/unknown.png')}}';">
                                        @else
                                            <img src="{{asset('backend/file_icons/'.getFileExtension(basename($v)).'.png')}}" alt="" style="width: 18px;margin-right: 5px;" onerror="javascript:this.src='{{asset('backend/file_icons/unknown.png')}}';">
                                        @endif

                                        {{basename($v)}}
                                    </a>
                                </td>
                                <td>{{format_bytes(filesize($v))}}</td>
                                <td>
                                    @if (is_readable($v) == true)
                                        <i class="fa fa-check" style="color: green;"></i>
                                        @else
                                        <i class="fa fa-close" style="color: red;"></i>
                                    @endif
                                </td>
                                <td>
                                    @if (is_writable($v) == true)
                                        <i class="fa fa-check" style="color: green;"></i>
                                    @else
                                        <i class="fa fa-close" style="color: red;"></i>
                                    @endif
                                </td>
                                <td>{{date('Y-m-d H:i:s',filemtime($v))}}</td>
                                <td>
                                    @if (in_array(getFileExtension(basename($v)),['css','html','php','js','txt','json']))
                                        <a href="javascript:;" data-path="public_path" data-name="{{$p_path.'/'.basename($v)}}" class="layui-btn layui-btn-xs app-file-edit"><i
                                                class="layui-icon"></i>编辑</a>
                                        <a href="javascript:;"
                                           class="layui-btn layui-btn-danger layui-btn-xs app-link-cate-del"><i class="layui-icon"></i>删除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if (isset($data['files']['resource_path'])&&count($data['files']['resource_path']) > 0)
                        @foreach($data['files']['resource_path'] as $v)
                            <tr>
                                <td>
                                    <a href="#" style="color:#009688">
                                        @if (in_array(getFileExtension(basename($v)),['jpg','png','gif','jpeg','bmp']))
                                            <img src="{{asset('backend/file_icons/image.png')}}" alt="" style="width: 18px;margin-right: 5px;" onerror="javascript:this.src='{{asset('backend/file_icons/unknown.png')}}';">
                                        @else
                                            <img src="{{asset('backend/file_icons/'.getFileExtension(basename($v)).'.png')}}" alt="" style="width: 18px;margin-right: 5px;" onerror="javascript:this.src='{{asset('backend/file_icons/unknown.png')}}';">
                                        @endif

                                        {{basename($v)}}
                                    </a>
                                </td>
                                <td>{{format_bytes(filesize($v))}}</td>
                                <td>
                                    @if (is_readable($v) == true)
                                        <i class="fa fa-check" style="color: green;"></i>
                                    @else
                                        <i class="fa fa-close" style="color: red;"></i>
                                    @endif
                                </td>
                                <td>
                                    @if (is_writable($v) == true)
                                        <i class="fa fa-check" style="color: green;"></i>
                                    @else
                                        <i class="fa fa-close" style="color: red;"></i>
                                    @endif
                                </td>
                                <td>{{date('Y-m-d H:i:s',filemtime($v))}}</td>
                                <td>
                                    @if (in_array(getFileExtension(basename($v)),['css','html','php','js','txt','json']))
                                        <a href="javascript:;" data-path="resource_path" data-name="{{$r_path.'/'.basename($v)}}" class="layui-btn layui-btn-xs app-file-edit"><i
                                                class="layui-icon"></i>编辑</a>
                                        <a href="javascript:;"
                                           class="layui-btn layui-btn-danger layui-btn-xs app-link-cate-del"><i class="layui-icon"></i>删除</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{asset('backend/plugins/codemirror/js/codemirror.js')}}"></script>
    <script src="{{asset('backend/plugins/codemirror/js/javascript.js')}}"></script>
    <script src="{{asset('backend/plugins/codemirror/js/sublime.js')}}"></script>
    <script>
        layui.use(['table', 'jquery','layer'], function () {
            var table = layui.table;
            var $ = layui.$;
            var layer = layui.layer;
            var editor;
            
            $('.app-file-edit').click(function () {
                $.post('template/info',{
                    'path':$(this).data('name'),
                    'dir':$(this).data('path'),
                    '_token':"{{csrf_token()}}"
                },function (res) {
                    if (res.code == 1){
                        layer.open({
                            type: 1,
                            title:'',
                            area: ['90%', '70%'],
                            btn: ['保存内容', '取消'],
                            yes: function(index, layero){
                                saveContent(res.data.dir,res.data.path,editor.getValue());
                            },
                            content: '<div id="codeBox" style="padding: 10px;box-sizing: border-box;"><textarea id="code" style="width: 100%;height: 100%;"></textarea></div>', //这里content是一个普通的String
                            success: function(layero, index){
                                editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                                    value:'',
                                    lineNumbers: true,
                                    mode: "javascript",
                                    keyMap: "sublime",
                                    autoCloseBrackets: true,
                                    matchBrackets: true,
                                    showCursorWhenSelecting: true,
                                    theme: "monokai",
                                    tabSize: 2
                                });
                                editor.setSize('100%',$('.layui-layer-content').height()-20+'px');
                                editor.setValue(res.data.content);
                            }
                        });
                    }else {
                        layer.msg(res.msg, {icon: 5});
                    }
                }).error(function (res) {
                    layer.msg(res.responseJSON.msg, {icon: 5});
                });

            });

            /**
             * 保存内容
             * @param dir
             * @param path
             * @param content
             */
            function saveContent(dir,path,content){
                $.post('template/save_content',{
                    'path':path,
                    'dir':dir,
                    'content':content,
                    '_token':"{{csrf_token()}}"
                },function (res) {
                    if (res.code == 1){
                        layer.msg(res.msg, {icon: 6});
                    }else {
                        layer.msg(res.msg, {icon: 5});
                    }
                    setTimeout(function () {
                        layer.closeAll();
                    },1000)
                }).error(function (res) {
                    layer.msg(res.responseJSON.msg, {icon: 5});
                    setTimeout(function () {
                        layer.closeAll();
                    },1000)
                });
            }

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
