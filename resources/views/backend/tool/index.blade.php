@extends('backend.layout')
@section('content')
    <div class="layui-fluid">
        <div class="layui-card" style="margin-bottom: 0;">
            <div class="layui-card-body" id="layui-card-body-content">
                <table class="layui-table" lay-even="" lay-skin="nob">
                    <colgroup>
                        <col>
                        <col width="200">
                        <col width="200">
                        <col width="150">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>软件名称</th>
                        <th>文件大小</th>
                        <th>文件类型</th>
                        <th>下载</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($files as $v)
                        <tr>
                            <td>{{$v['name']}}</td>
                            <td>{{format_bytes($v['size'])}}</td>
                            <td>{{$v['extension']}}</td>
                            <td>
                                <a href="{{route('tool.down',['file'=>$v['name']])}}"
                                   class="layui-btn layui-btn-xs"
                                ><i
                                        class="fa fa-download" style="font-size: 12px !important;"></i> 下载
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
