@extends('backend.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('backend/style/template.css')}}">
@stop
@section('content')
    <div class="layui-fluid" style="padding: 0">
        <div class="layadmin-caller">
            <form class="layui-form caller-seach" action="">
                <i class="layui-icon layui-icon-search caller-seach-icon caller-icon"></i>
                <input type="text" name="title" required="" lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input caller-pl32">
                <i class="layui-icon layui-icon-close caller-dump-icon caller-icon"></i>
            </form>
            <div class="layui-tab layui-tab-brief caller-tab" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this">所有留言信息(共80条)</li>
                </ul>
            </div>
            <div class="caller-contar">
                @if (isset($datas) && count($datas)>0)
                    @foreach ($datas as $v)
                        <div class="caller-item">
                            <img src="../../layuiadmin/style/res/template/portrait.png" alt="" class="caller-img caller-fl">
                            <div class="caller-main caller-fl">
                                <p><strong>{{$v->name}}</strong> <em>最近联系：{{\Carbon\Carbon::parse($v->created_at)->diffForHumans()}}</em></p>
                                <p class="caller-adds"><i class="layui-icon layui-icon-location"></i>{{$v->city}}</p>
                                <p class="caller-adds"><i class="fa fa-envelope-o"></i>{{$v->email}}</p>
                                <p class="caller-adds"><i class="layui-icon layui-icon-cellphone"></i>{{$v->phone}}</p>
                                <div class="caller-iconset">
                                    {{$v->content}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>暂无数据</p>
                @endif
            </div>
            <div id="demo1"><div class="layui-box layui-laypage layui-laypage-default" id="layui-laypage-1"><a href="javascript:;" class="layui-laypage-prev layui-disabled" data-page="0">上一页</a><span class="layui-laypage-curr"><em class="layui-laypage-em"></em><em>1</em></span><a href="javascript:;" data-page="2">2</a><a href="javascript:;" data-page="3">3</a><a href="javascript:;" data-page="4">4</a><a href="javascript:;" data-page="5">5</a><span class="layui-laypage-spr">…</span><a href="javascript:;" class="layui-laypage-last" title="尾页" data-page="7">7</a><a href="javascript:;" class="layui-laypage-next" data-page="2">下一页</a></div></div>
        </div>
    </div>
@stop
@section('script')
    <script>
        layui.use(['table', 'jquery'], function () {
            var table = layui.table;
            var $ = layui.$;
        });
    </script>
@stop
