@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@stop
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(isset($system))
                {!! Form::model($system,['url'=>'admin/system/'.$system->id,'class'=>'app-system-form']) !!}
                {{method_field('PUT')}}
                <input type="hidden" name="systemId" value="{{$system->id}}">
            @else
                {!! Form::open(['route'=>'system.store','class'=>'app-system-form']) !!}
            @endif
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>分类</label>
                    <div class="col-sm-3">
                        <select name="tabType" class="form-control select2">
                            <option value="base" {{isset($system) && ($system->tabType == 'base') ? 'selected' : ''}}>基本配置</option>
                            <option value="file" {{isset($system) && ($system->tabType == 'file') ? 'selected' : ''}}>附件配置</option>
                            <option value="email" {{isset($system) && ($system->tabType == 'email') ? 'selected' : ''}}>邮箱配置</option>
                            <option value="other" {{isset($system) && ($system->tabType == 'other') ? 'selected' : ''}}>自定义配置</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>标题</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','title',old('title'),['class'=>'form-control','placeholder'=>'请输入标题','autocomplete'=>'off']) !!}
                    </div>
                    <small class="form-text text-muted mt-0" style="line-height: 2.2rem">请使用中文名称.</small>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>调用别名</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入调用别名','autocomplete'=>'off']) !!}
                    </div>
                    <small class="form-text text-muted mt-0" style="line-height: 2.2rem">请使用字母或者字母加下划线.</small>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-12 col-md-1 col-form-label text-right">类型</label>
                    <div class="col-sm-12 col-md-6 d-flex align-items-center" id="config-style">
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('type','input',true,['class'=>'custom-control-input','id'=>'t-input']) !!}
                            <label class="custom-control-label font-weight-normal" for="t-input">input</label>
                        </div>
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('type','radio',false,['class'=>'custom-control-input','id'=>'t-radio']) !!}
                            <label class="custom-control-label font-weight-normal" for="t-radio">radio</label>
                        </div>
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('type','image',false,['class'=>'custom-control-input','id'=>'t-image']) !!}
                            <label class="custom-control-label font-weight-normal" for="t-image">image</label>
                        </div>
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('type','select',false,['class'=>'custom-control-input','id'=>'t-select']) !!}
                            <label class="custom-control-label font-weight-normal" for="t-select">select</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row" id="value_box">
                    <label  class="col-sm-1 col-form-label text-right app-value-label">默认值</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','value',old('value'),['class'=>'form-control','placeholder'=>'请输入默认值']) !!}
                    </div>
                    <small class="form-text text-muted mt-0" style="line-height: 2.2rem">多个请用|分割,比如男|女！.</small>
                </div>

                <div class="form-group row" id="img_box">
                    <label class="col-sm-1 col-form-label text-right app-value-label"></label>
                    <div class="col-sm-3 app-file-upload-btn">
                        <div id="upload-avatar" class="btn btn-secondary"><i class="fa fa-upload"></i>上传图片</div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-1 col-form-label text-right app-content-label">内容</label>
                        <div class="col-sm-11">
                            {!! Form::textarea('content',old('content'),['class'=>'form-control system_content','placeholder'=>'','rows'=>3]) !!}
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


@section('script')
    <script src="{{asset('backend/assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2(
            {
                minimumResultsForSearch: -1
            }
        );
            var upload = layui.upload;


            @if(isset($system))
            showTypeBox("{{$system->type}}");
            @endif

            $('#config-style').find('input').change(function () {
                showTypeBox($(this).val());
            });

            showTypeBox($('input:radio[name="type"]:checked').val());

            //表单验证
            $('.app-system-form').submit(function(){
                if($("input[name='title']").val() == ''){
                    swal({
                        icon: "error",
                        timer: '2000',
                        button:false,
                        text: '标题不能为空！'
                    });
                    return false;
                }
                if($("input[name='name']").val() == ''){
                    swal({
                        icon: "error",
                        timer: '2000',
                        button:false,
                        text: '调用别名不能为空！'
                    });
                    return false;
                }
                if($('input:radio[name="type"]:checked').val() == 'radio' || $('input:radio[name="type"]:checked').val() == 'select'){
                    if ($("input[name='value']").val() == ''){
                        swal({
                            icon: "error",
                            timer: '2000',
                            button:false,
                            text: '默认值不能为空！'
                        });
                        return false;
                    }
                    if ($("textarea[name='content']").val() == ''){
                        swal({
                            icon: "error",
                            timer: '2000',
                            button:false,
                            text: '内容不能为空！'
                        });
                        return false;
                    }
                }

            });

            function showTypeBox(type) {
                if (type == 'radio' || type == 'select') {
                    $('#value_box').show();
                    var info='<i style="color: red;margin-right: 10px;">*</i>';
                    if ($('.app-content-label i').length == 0){
                        $('.app-content-label').append(info);
                    }
                    if ($('.app-value-label i').length == 0){
                        $('.app-value-label').append(info);
                    }
                } else {
                    $('#value_box').hide();
                    $('.app-content-label,.app-value-label').find('i').remove(info);
                }
                if (type == 'image') {
                    $('#img_box').show();
                } else {
                    $('#img_box').hide();
                }
            }

            var uploadInst = upload.render({
                elem: '#upload-avatar', //绑定元素
                url: "{{route('file.upload')}}", //上传接口
                accept: 'images',
                acceptMime: 'image/*',
                exts: "{{config('system_config.site_img_type')}}",
                multiple: false,
                data: {
                    "_token": "{{csrf_token()}}",
                    'f_type':'img'
                },
                done: function (res) {
                    //上传完毕回调
                    $(".system_content").val(res.data.path);
                },
                error: function (index, upload) {
                    //请求异常回调
                    swal({
                        icon: "error",
                        timer: '2000',
                        button:false,
                        text: '上传失败！'
                    });
                }
            });
    </script>
@stop
