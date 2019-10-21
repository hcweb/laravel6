@extends('backend.layout')
@section('css')
    <link rel="stylesheet" href="{{asset('backend/assets/libs/treeview/style.css')}}">
@stop
@section('content')
    <div class="row">

        <!-- Right Sidebar -->
        <div class="col-12">
            <div class="card-box">
                <!-- Left sidebar -->
                <div class="inbox-leftbar">

                    <button class="btn btn-danger btn-block waves-effect waves-light mb-2"><i class="fa fa-list-alt" style="margin-right: 10px;"></i>导航菜单</button>
                    <div id="checkTree"></div>

                </div>
                <!-- End Left sidebar -->

                <div class="inbox-rightbar">
                    <iframe src="" id="app-main-content" width='100%' height='100%' frameborder='0'  scrolling="no" style="overflow: visible;"></iframe>
                </div>
                <!-- end inbox-rightbar-->

                <div class="clearfix"></div>
            </div> <!-- end card-box -->

        </div> <!-- end Col -->
    </div>


@stop
@section('script')
    <script src="{{asset('backend/assets/libs/treeview/jstree.min.js')}}"></script>
    <script>


        $(function () {
            if (@json($categorys).length > 0){
                $('#app-main-content').attr('src',@json($categorys)[0].iframe_url);
            }
            $("#checkTree").jstree({
                core: {
                    check_callback: !0,
                    themes: {
                        responsive: !1
                    },
                    data: @json($categorys)
                },
                types: {
                    default: {
                        icon: "fa fa-folder text-warning"
                    },
                    file: {
                        icon: "fa fa-file text-primary"
                    }
                },
                plugins: ["dnd", "search", "state", "types", "wholerow","changed"]
            }).on("changed.jstree", function (e, data) {
                if(data.node != undefined){
                    $('#app-main-content').attr('src',data.node.original.iframe_url);
                }

                console.log(data); // newly selected
            })
        });


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

        function showTost(){
            swal({
                text: "123",
                icon: "error",
                timer: '2000',
                button:false
            });
        }
    </script>
@stop
