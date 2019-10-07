<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(isset($block))
                {!! Form::model($block,['url'=>'admin/block/'.$block->id,'class'=>'form-horizontal']) !!}
                {{method_field('PUT')}}
            @else
                {!! Form::open(['route'=>'block.store','class'=>'form-horizontal']) !!}
            @endif
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">名称</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','title',old('title'),['class'=>'form-control','placeholder'=>'请输入资料名称','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-12 col-md-1 col-form-label text-right">类型</label>
                    <div class="col-sm-12 col-md-6 d-flex align-items-center">
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('type','F','checked',['id'=>'block_type_f','class'=>'custom-control-input block_type']) !!}
                            <label class="custom-control-label font-weight-normal" for="block_type_f">文字</label>
                    </div>
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('type','I','',['id'=>'block_type_i','class'=>'custom-control-input block_type']) !!}
                            <label class="custom-control-label font-weight-normal" for="block_type_i">图片</label>
                        </div>

                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('type','E','',['id'=>'block_type_e','class'=>'custom-control-input block_type']) !!}
                            <label class="custom-control-label font-weight-normal" for="block_type_e">富文本</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">资料内容</label>
                    <div class="col-sm-11 block_type_box_F" >
                        {!! Form::textarea('body[F]',old('body[F]'),['class'=>'form-control','placeholder'=>'','rows'=>6]) !!}
                    </div>
                    <div class="col-sm-11 block_type_box_I" style="display: none">
                        <div class="row">
                            <div class="col-sm-3">
                                {!! Form::input('text','body[I]',old('body[I]'),['class'=>'form-control app-block-img','placeholder'=>'','autocomplete'=>'off']) !!}
                            </div>
                            <div class="app-file-upload-btn">
                                <a class="btn btn-secondary" id="upload-avatar" style="color: #ffffff;"><i class="fa fa-upload"></i>上传图片</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-11 block_type_box_E" style="display: none">
                        <!-- 编辑器容器 -->
                        <script id="container" name="body[E]" value="body[E]" type="text/plain">
                            @if(isset($block) && $block->type=='E')
                                {!! $block->body['E'] !!}
                            @endif
                        </script>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label  class="col-sm-1 col-form-label text-right"></label>
                    <div class="col-sm-11">
                        <button class="btn btn-rounded btn-primary mr-2"><i
                                class="fa fa-save"></i>
                            保存
                        </button>
                        <button type="reset" class="btn btn-rounded btn-warning mr-2"><i
                                class="fa fa-retweet"></i> 重置
                        </button>
                        <a href="javascript:history.go(-1)" class="btn btn-rounded btn-light"><i
                                class="fa fa-undo"></i> 返回上一级</a>
                    </div>
                </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>


@include('vendor.ueditor.assets')
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
@section('script')
    <script>
            var upload = layui.upload;


            $('.block_type').change(function () {
                showTypeBox($(this).val());
            });


            @if(isset($block))
            showTypeBox("{{$block->type}}");
            @endif

            showTypeBox($('input:radio[name="type"]:checked').val());

            function showTypeBox(type) {
                // alert(type);
                if (type == 'I') {
                    $('.block_type_box_' + type).show();
                    $('.block_type_box_E').hide();
                    $('.block_type_box_F').hide();
                }
                if (type == 'E') {
                    $('.block_type_box_' + type).show();
                    $('.block_type_box_I').hide();
                    $('.block_type_box_F').hide();
                }
                if (type == 'F') {
                    $('.block_type_box_' + type).show();
                    $('.block_type_box_I').hide();
                    $('.block_type_box_E').hide();
                }
            }


            var uploadInst = upload.render({
                elem: '#upload-avatar', //绑定元素
                url: "{{route('file.upload')}}", //上传接口
                accept:'images',
                acceptMime:'image/*',
                exts:"{{config('system_config.site_img_type')}}",
                multiple:false,
                data:{
                    "_token": "{{csrf_token()}}",
                    'f_type':'img'
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

    </script>
@stop
