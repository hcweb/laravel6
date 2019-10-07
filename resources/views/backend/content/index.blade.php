@extends('backend.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('backend/style/eleTree.css')}}">
@stop
@section('content')
    <div class="layui-fluid">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md2">
                <div class="layui-card">
                    <div class="layui-card-header"><i class="fa fa-list-alt" style="margin-right: 10px;"></i>导航菜单</div>
                    <div class="layui-card-body">
                        {{--<input type="text" class="layui-input" placeholder="請輸入欄目標題" id="app-cate-search">--}}
                        <div class="ele1"></div>
                    </div>
                </div>
            </div>
            <div class="layui-col-md10">
                <iframe src="" id="app-main-content" width='100%' height='100%' frameborder='0' scrolling="no" style="overflow: visible;"></iframe>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>

        console.log(@json($categorys));

        //计算页面的实际高度，iframe自适应会用到
        function calcPageHeight(doc) {
            var cHeight = Math.max(doc.body.clientHeight, doc.documentElement.clientHeight);
            var sHeight = Math.max(doc.body.scrollHeight, doc.documentElement.scrollHeight);
            var height  = Math.max(cHeight, sHeight);
            return height;
        }


        //根据ID获取iframe对象
        var ifr = document.getElementById('app-main-content');
        ifr.onload = function() {
            //解决打开高度太高的页面后再打开高度较小页面滚动条不收缩
            ifr.style.height='0px';
            var iDoc = ifr.contentDocument || ifr.document;
            var height = calcPageHeight(iDoc);
            ifr.style.height = height + 'px';
            console.log(@json($categorys)[0].iframe_url);
        };


        /**
         * 提供子類調用
         */
        function setHeight(){
            ifr.style.height='0px';
            var iDoc = ifr.contentDocument || ifr.document;
            var height = calcPageHeight(iDoc);
            ifr.style.height = height + 'px';
        }

        layui.use(['table', 'jquery', 'form','eleTree'], function () {
            var table = layui.table;
            var $ = layui.$;
            var form = layui.form;
            var eleTree=layui.eleTree;
            var el=eleTree.render({
                elem: '.ele1',
                data: @json($categorys),
                showCheckbox: false,
                highlightCurrent: true,
                accordion: true,
                defaultExpandedKeys:[0],
                //searchNodeMethod:true,
                request: {     // 对后台返回的数据格式重新定义
                    name: "title",
                    key: "id",
                    children: "children",
                    checked: "checked",
                    disabled: "disabled",
                }
            });
            eleTree.on("nodeClick",function(d) {
                $('#app-main-content').attr('src',d.data.currentData.iframe_url);
            });

            $(function () {
                if (@json($categorys).length > 0){
                    $('#app-main-content').attr('src',@json($categorys)[0].iframe_url);
                }
            })
        });
    </script>
@stop
