@extends('frontend.layout')
@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0 pr-0 pb-0" style="background: none;">
            <li class="breadcrumb-item"><a href="{{url('/')}}">首页</a></li>
            <li class="breadcrumb-item active" aria-current="page">工具软件</li>
        </ol>
    </nav>
    <div class="col-12 bg-white mb-md-5 pt-3">
        <table class="table table-striped">
            <colgroup>
                <col>
                <col width="200">
                <col width="200">
                <col width="150">
            </colgroup>
            <thead class="thead-dark">
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
                        <a href="{{route('home.tool.down',['file'=>$v['name']])}}"
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
@endsection
