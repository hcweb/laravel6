@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@if(isset($f_data))
    {!! Form::model($f_data,['url'=>'admin/'.$mould_name.'/'.$f_data->id,'class'=>'form-horizontal']) !!}
    {{method_field('PUT')}}
@else
    {!! Form::open(['route'=>$mould_name.'.store','class'=>'form-horizontal']) !!}
@endif
<input type="hidden" name="mould_id" value="{{request('mid')}}">
<input type="hidden" name="category_id" value="{{request('cid')}}">
<ul class="nav nav-tabs nav-bordered">
    <li class="nav-item">
        <a href="#base" data-toggle="tab" aria-expanded="false" class="nav-link active">
            <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
            <span class="d-none d-sm-inline-block">常规选项</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#seo" data-toggle="tab" aria-expanded="true" class="nav-link">
            <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
            <span class="d-none d-sm-inline-block">SEO选项</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#other" data-toggle="tab" aria-expanded="false" class="nav-link">
            <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
            <span class="d-none d-sm-inline-block">其他选项</span>
        </a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active show" id="base">
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>软件标题</label>
            <div class="col-sm-4">
                {!! Form::input('text','title',old('title'),['class'=>'form-control category-title','placeholder'=>'请输入标题']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>软件别名</label>
            <div class="col-sm-4">
                {!! Form::input('text','alias',old('alias'),['class'=>'form-control category-alias','placeholder'=>'不输入则自动翻译']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label text-right">封面图片</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-5">
                        {!! Form::input('text','thumb',old('thumb'),['class'=>'form-control app-block-img','autocomplete'=>'off']) !!}
                    </div>
                    <div class="app-file-upload-btn">
                        <a class="btn btn-secondary" id="upload-avatar" style="color: #ffffff;"><i class="fa fa-upload"></i>上传图片</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label">作者</label>
            <div class="col-sm-4">
                {!! Form::input('text','author',old('author'),['class'=>'form-control','autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label">来源</label>
            <div class="col-sm-4">
                {!! Form::input('text','source',old('source'),['class'=>'form-control','autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label">发布时间</label>
            <div class="col-sm-4">
                {!! Form::input('text','push_time',old('push_time'),['class'=>'form-control','autocomplete'=>'off','id'=>'datetime']) !!}
            </div>
        </div>
        @include('backend.common._field_data')
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label">摘要</label>
            <div class="col-sm-10">
                {!! Form::textarea('summary',old('summary'),['class'=>'form-control','rows'=>'3']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-12 col-md-2 col-form-label text-right">是否显示</label>
            <div class="col-sm-12 col-md-10 d-flex align-items-center">
                <div class="custom-control custom-radio pr-2">
                    {!! Form::radio('is_show',1,true,['class'=>'custom-control-input','id'=>'show_customRadio1']) !!}
                    <label class="custom-control-label font-weight-normal" for="show_customRadio1">显示</label>
                </div>
                <div class="custom-control custom-radio pr-2">
                    {!! Form::radio('is_show',0,false,['class'=>'custom-control-input','id'=>'show_customRadio2']) !!}
                    <label class="custom-control-label font-weight-normal" for="show_customRadio2">隐藏</label>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="seo">
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label text-right">SEO标题</label>
            <div class="col-sm-4">
                {!! Form::input('text','seo_title',old('seo_title'),['class'=>'form-control','autocomplete'=>'off']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label text-right">SEO关键字</label>
            <div class="col-sm-10">
                {!! Form::textarea('seo_key',old('seo_key'),['class'=>'form-control','rows'=>'3']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label text-right">SEO描述</label>
            <div class="col-sm-10">
                {!! Form::textarea('seo_content',old('seo_content'),['class'=>'form-control','rows'=>'3']) !!}
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="other">

        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label">标签</label>
            <div class="col-sm-4">
                <select name="tags" class="form-control select2" multiple="multiple">
                    @foreach($tags as $v)
                        <option value="{{$v->id}}" {{isset($f_data) && (in_array($v->id,collect($f_data->tags->pluck('id'))->toArray())) ? 'selected' : ''}}>
                            {{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label">跳转URL</label>
            <div class="col-sm-4">
                {!! Form::input('text','url',old('url'),['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="row form-group">
            <label class="col-sm-2 text-right col-form-label">浏览次数</label>
            <div class="col-sm-1">
                {!! Form::input('text','views',isset($f_data) && $f_data->views != 0 ? $f_data->views : 0,['class'=>'form-control',"onkeyup"=>"value=value.replace(/[^0-9\.]/g,'')"]) !!}
            </div>
        </div>
    </div>
    <div class="form-group row mt-4">
        <label  class="col-sm-2 col-form-label text-right"></label>
        <div class="col-sm-10">
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
</div>
{!! Form::close() !!}

@include('vendor.ueditor.assets')
@section('script')
    <script src="{{asset('backend/assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/plugins/BaiDuTranslate/md5.js')}}"></script>
    <script src="{{asset('backend/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    @include('backend.common._ifram')
    <!-- 实例化编辑器 -->
    {{--<script type="text/javascript">--}}
    {{--var ue = UE.getEditor('container',{--}}
    {{--autoHeightEnabled: false,--}}
    {{--initialFrameHeight:400--}}
    {{--});--}}
    {{--ue.ready(function() {--}}
    {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.--}}
    {{--});--}}

    {{--</script>--}}

    <script>
        $(".select2").select2({
            minimumInputLength : 0,
            placeholder:"可多选",//默认值
        });
        var upload = layui.upload;
        var laydate = layui.laydate;



        laydate.render({
            elem: '#datetime'
            ,type: 'datetime'
            ,value:new Date()
        });

        $(".category-title").blur(function () {
            if ($(this).val() != '') {
                translate($(this).val());
            }
        });


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

        //百度翻譯
        function translate($query) {
            $.get('/translate/' + $query, function (response) {
                if (response.success == true) {
                    $(".category-alias").val(response.data);
                }
            });
        };

        @include('backend.common._field_data_js')
    </script>
@stop
