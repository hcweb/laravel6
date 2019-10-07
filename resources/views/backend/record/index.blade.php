@extends('backend.layout')
@section('css')
    <style>
.app-record-box{display: flex;justify-content: center;align-items: center;margin-top: 50px;margin-bottom: 50px;flex-direction: column;}
.app-record-box input[type='text']{width: 40%;}
.app-record-box .btn-box{padding-top: 30px;padding-bottom: 30px;}
.app-record-box .btn-box i{font-size: 16px;margin-right: 6px;}
    </style>
@stop
@section('content')
    <div class="layui-fluid">
        <div class="layui-card">
            <div class="layui-card-body">
                {!! Form::open(['route' => 'record.index', 'method' => 'post']) !!}
                    <div class="app-record-box">
                        {!! Form::text('filePath', $fullPath, ['class' => 'layui-input','placeholder'=>'请填入文件夹全路径']) !!}
                   <div class="btn-box">
                       <button class="layui-btn layui-btn-warm" id="app-see"><i class="fa fa-eye"></i>预览</button>
                       <button class="layui-btn" id="app-import"><i class="fa fa-database" id="app-see"></i>导入</button>
                   </div>
                    </div>
                    {{--<div class="app-record-box">--}}
                        {{--<div class="btn-box">--}}
                            {{--<button class="layui-btn layui-btn-primary"><i class="fa fa-file" style="margin-right: 10px;"></i>选取文件夹</button>--}}
                            {{--<input id="file-dir" name="fileDir[]" type="file" data-type="dir" webkitdirectory/>--}}
                        {{--</div>--}}
                        {{--<div class="btn-box">--}}
                            {{--<button class="layui-btn layui-btn-success"><i class="fa fa-file-text" style="margin-right: 10px;"></i>选取文件</button>--}}
                            {{--<input id="file-list" name="fileList[]" type="file" data-type="file" multiple accept=".txt"/>--}}
                        {{--</div>--}}
                        {{--<div class="btn-box">--}}
                            {{--<button class="layui-btn layui-btn-success" type="button" id="app-record-import"><i class="fa fa-file-text" style="margin-right: 10px;"></i>导入</button>--}}
                        {{--</div>--}}
                        {{--<input type="hidden" name="type" value="" id="file-hidden-type">--}}
                    {{--</div>--}}
                    <input type="hidden" name="type" value="" id="file-hidden-type">
                {!! Form::close() !!}
                @if (count($data) > 0)
                <h3>所有文件列表{{count($data)}}个文件</h3>
                <table class="layui-table">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th>书名</th>
                        <th>ISBN</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $v)
                            <tr class="unread" @if (!isset($v['b_name']) || !isset($v['b_isbn']))style="background: red;color: #ffffff;" @endif>
                                <td>{{isset($v['b_name']) ? $v['b_name'] : '请填写书名'}}</td>
                                <td>{{isset($v['b_isbn']) ? $v['b_isbn'] : '请填写ISBN'}}</td>
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
        layui.use(['table', 'jquery'], function () {
            var table = layui.table;
            var $ = layui.$;

            $('#app-see').click(function () {
                if ($('input[name=filePath]').val() == ''){
                    layer.msg('请填写文件夹路径！', {icon: 5});
                    return false;
                }
                $('#file-hidden-type').val('see');
            });
            $('#app-import').click(function () {
                if ($('input[name=filePath]').val() == ''){
                    layer.msg('请填写文件夹路径！', {icon: 5});
                    return false;
                }
                $('#file-hidden-type').val('import');
            });
        });
    </script>
@stop
