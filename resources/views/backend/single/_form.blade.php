@section('css')
    <style>
        .layui-form-select dl{z-index: 9999;}
    </style>
@stop
<div class="layui-card" style="margin-bottom: 0;">
        {{--<div class="layui-card-header">--}}
            {{--{{isset($f_data)?'修改':'添加'}}单页--}}
        {{--</div>--}}
        <div class="layui-card-body" id="layui-card-body-content">
            <div class="layui-form"
                 style="padding: 0;">
                @if(isset($f_data))
                    {!! Form::model($f_data,['url'=>'admin/single/'.$f_data->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                    <input type="hidden" name="singleId" value="{{$f_data->id}}">
                @else
                    {!! Form::open(['route'=>'single.store','class'=>'form-horizontal']) !!}
                    <input type="hidden" name="mould_id" value="{{request('mid')}}">
                    <input type="hidden" name="category_id" value="{{request('cid')}}">
                @endif
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this app-tab-menu">常规选项</li>
                    <li class="app-tab-menu">SEO选项</li>
                    <li class="app-tab-menu">其他选项</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">



                        <div class="layui-form-item">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>标题</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','title',old('title'),['class'=>'layui-input category-title','placeholder'=>'请输入标题','lay-verify'=>'required','autocomplete'=>'off']) !!}
                            </div>
                        </div>



                        <div class="layui-form-item">
                            <label class="layui-form-label">封面图片</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','thumb',old('thumb'),['class'=>'layui-input app-block-img','autocomplete'=>'off']) !!}
                            </div>
                            <a class="layui-btn" id="upload-avatar"><i class="fa fa-upload"></i>上传图片</a>
                        </div>
                        @include('backend.common._field_data')
                        <div class="layui-form-item">
                            <label class="layui-form-label">内容详情</label>

                            <div class="layui-input-block">
                                <!-- 编辑器容器 -->
                                <script id="container" name="description" value="description" type="text/plain">
                                    @if(isset($f_data))
                                        {!! $f_data->description !!}
                                    @endif
                                </script>
                            </div>
                        </div>
                    </div>
                    {{--SEO--}}
                    <div class="layui-tab-item">
                        <div class="layui-form-item">
                            <label class="layui-form-label">SEO标题</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','seo_title',old('seo_title'),['class'=>'layui-input','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">SEO关健字</label>
                            <div class="layui-input-block">
                                <div class="layui-col-md4">
                                    {!! Form::textarea('seo_key',old('seo_key'),['class'=>'layui-textarea','rows'=>'2']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">SEO描述</label>
                            <div class="layui-input-block">
                                <div class="layui-col-md4">
                                    {!! Form::textarea('seo_content',old('seo_content'),['class'=>'layui-textarea','rows'=>'2']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--内容设置--}}
                    <div class="layui-tab-item">
                        <div class="layui-form-item">
                            <label class="layui-form-label">作者</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','author',old('author'),['class'=>'layui-input','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">來源</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','source',old('source'),['class'=>'layui-input','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">发布时间</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','push_time',old('push_time'),['class'=>'layui-input','autocomplete'=>'off','id'=>'datetime']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">浏览次数</label>
                            <div class="layui-input-inline">
                                <div class="layui-col-md4">
                                    {!! Form::input('text','views',isset($f_data) && $f_data->views != 0 ? $f_data->views : 0,['class'=>'layui-input','lay-verify'=>'number','placeholder'=>'']) !!}
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button lay-submit class="layui-btn"><i
                                    class="fa fa-save"></i>
                                保存
                            </button>
                            <button type="reset" class="layui-btn layui-btn-warm"><i
                                    class="fa fa-retweet"></i> 重置
                            </button>
                            <a href="javascript:history.go(-1)" class="layui-btn layui-btn-primary"><i
                                    class="fa fa-undo"></i> 返回上一级</a>
                        </div>
                        </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@include('vendor.ueditor.assets')
@section('script')
    <script src="{{asset('backend/plugins/BaiDuTranslate/md5.js')}}"></script>
    @include('backend.common._ifram')
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{
            autoHeightEnabled: false,
            initialFrameHeight:400
        });
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });

    </script>

    <script>
        layui.use(['jquery','form','colorpicker','laydate','upload'],function () {
            var $ = layui.$;
            var form = layui.form;
            var colorpicker = layui.colorpicker;
            var laydate= layui.laydate;
            var upload=layui.upload;

            $(".category-title").blur(function () {
                if ($(this).val() != '') {
                    translate($(this).val());
                }
            });

            laydate.render({
                elem: '#datetime'
                ,type: 'datetime'
                ,value:new Date()
            });

            var uploadInst = upload.render({
                elem: '#upload-avatar', //绑定元素
                url: "{{route('file.upload')}}", //上传接口
                accept:'images',
                acceptMime:'image/*',
                exts:'jpg|png|gif|bmp|jpeg',
                multiple:false,
                data:{
                    "_token": "{{csrf_token()}}"
                },
                done: function(res){
                    //上传完毕回调
                    $(".app-block-img").val(res.data.path);
                },
                error: function(index, upload){
                    //请求异常回调
                    layer.msg("上传失败！", {icon: 5});
                }
            });

            //百度翻譯
            function translate($query) {
                $.get('/translate/' + $query, function (response) {
                    if (response.success == true) {
                        $(".category-alias").val(response.data);
                    }
                });
            };


            var mFields=@json($fields);
            for (var i=0;i<mFields.length;i++){
                switch (mFields[i].type) {
                    case 'datetime':
                        laydate.render({
                            elem: '#'+mFields[i].name+'_'+mFields[i].id
                            ,type: 'datetime'
                            ,value:new Date()
                        });
                        break;
                    case 'htmltext':
                        var ue = UE.getEditor(mFields[i].name+'_'+mFields[i].id,{
                            autoHeightEnabled: false,
                            initialFrameHeight:400
                        });
                        ue.ready(function() {
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                        });
                        break;
                    case 'img':
                        upload.render({
                            elem: '#'+mFields[i].name+'_'+mFields[i].id+'_img_btn', //绑定元素
                            url: "{{route('file.upload')}}", //上传接口
                            accept:'images',
                            acceptMime:'image/*',
                            exts:'jpg|png|gif|bmp|jpeg',
                            multiple:false,
                            data:{
                                "_token": "{{csrf_token()}}"
                            },
                            done: function(res,index,){
                                //上传完毕回调
                                $("#"+$(this.item).data('id')).val(res.data.path);
                            },
                            error: function(index, upload){
                                //请求异常回调
                                layer.msg("上传失败！", {icon: 5});
                            }
                        });
                        break;
                    case 'imgs':
                        upload.render({
                            elem: '#'+mFields[i].name+'_'+mFields[i].id+'_img_btn', //绑定元素
                            url: "{{route('file.upload')}}", //上传接口
                            accept:'images',
                            number:5,
                            acceptMime:'image/*',
                            exts:'jpg|png|gif|bmp|jpeg',
                            multiple:true,
                            data:{
                                "_token": "{{csrf_token()}}"
                            },
                            before: function(obj){
                                console.log(obj);
                                return;
                            },
                            done: function(res,index){
                                //上传完毕回调
                                if (res.success == true){
                                    var html='<div class="imgs_item_box">'+
                                        '<i class="fa fa-close app-file-delete" data-path="'+res.data.path+'" data-id="'+$(this.item).data('id')+'" data-name="'+$(this.item).data('name')+'"></i>'+
                                        '<img src="'+res.data.path+'" alt="">'+
                                        '<input type="hidden" value="'+res.data.path+'" name="'+$(this.item).data('name')+'[]">'+
                                        '</div>';
                                    $("#"+$(this.item).data('id')+'_imgb_box').append(html);
                                    deleteFile();
                                }else {
                                    layer.msg("上传失败！", {icon: 5});
                                }
                            },
                            error: function(index, upload){
                                //请求异常回调
                                layer.msg("上传失败！", {icon: 5});
                            }
                        });
                        break;
                    case 'switch':
                        form.on('switch('+mFields[i].name+'_'+mFields[i].id+')', function(data){
                            console.log(data.elem.checked); //开关是否开启，true或者false
                            if (data.elem.checked == true){
                                $(data.elem).val(1);
                            }else{
                                $(data.elem).val(0);
                            }
                        });
                        break;
                    case 'color':
                        colorpicker.render({
                            elem: '#'+mFields[i].name+'_'+mFields[i].id+'color' //绑定元素
                            ,predefine:true
                            ,color:$('#'+mFields[i].name+'_'+mFields[i].id).val()
                            ,change: function(color){ //颜色改变的回调
                                layer.tips('选择了：'+ color, this.elem, {
                                    tips: 1
                                });
                               $('#'+$(this.elem).data('id')).val(color);
                            }
                        });
                        break;
                }
            }

            deleteFile();
            function deleteFile(){
                $('.app-file-delete').click(function () {
                    var path=$(this).data('path');
                    var pId=$(this).data('id');
                    var pName=$(this).data('name');
                    //删除本地文件
                    $.post("{{route('file.remove')}}",{
                        'path':path,
                        '_token':"{{csrf_token()}}"
                    },function (response) {
                        if (response.success == true){

                        }
                    });

                    $('#'+pId+'_imgb_box').find('img').each(function (index,element) {
                        if ($(this).attr('src') == path){
                            $(this).parent().remove();
                        }
                    });

                    if ($('#'+pId+'_imgb_box').find('.imgs_item_box').length == 0){
                        $('#'+pId+'_imgb_box').append('<input type="hidden" value="" name="'+pName+'">');
                    }
                });
            }


        });
    </script>

@stop
