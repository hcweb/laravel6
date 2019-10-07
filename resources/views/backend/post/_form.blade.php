@section('css')
    <style>
        .layui-form-select dl{z-index: 9999;}
    </style>
    <link rel="stylesheet" href="{{asset('backend/style/formSelects-v4.css')}}">
@stop
@section('t-script')
    <script src="{{asset('static/sortable/Sortable.min.js')}}"></script>
@stop
<div class="layui-card" style="margin-bottom: 0;">
        {{--<div class="layui-card-header">--}}
            {{--{{isset($f_data)?'修改':'添加'}}单页--}}
        {{--</div>--}}
        <div class="layui-card-body" id="layui-card-body-content">
            <div class="layui-form"
                 style="padding: 0;">
                @if(isset($f_data))
                    {!! Form::model($f_data,['url'=>'admin/'.$mould_name.'/'.$f_data->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                @else
                    {!! Form::open(['route'=>$mould_name.'.store','class'=>'form-horizontal']) !!}
                @endif
                    <input type="hidden" name="mould_id" value="{{request('mid')}}">
                    <input type="hidden" name="category_id" value="{{request('cid')}}">
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

                        <div class="layui-form-item" style="display: none;">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>调用别名</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','alias',old('alias'),['class'=>'layui-input category-alias','placeholder'=>'不输入则自动翻译','lay-verify'=>'required','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                       <!-- <div class="layui-form-item">
                            <label class="layui-form-label">字体样式</label>
                            <div class="layui-input-inline">
                                {!! Form::checkbox('font_style[]',0,isset($f_data) && str_contains($f_data->font_style,'0') ? 'checked' : '',['class'=>'layui-input','title'=>'加粗','lay-skin'=>"primary"]) !!}
                                {!! Form::checkbox('font_style[]',1,isset($f_data) && str_contains($f_data->font_style,'1') ? 'checked' : '',['class'=>'layui-input','title'=>'倾斜','lay-skin'=>"primary"]) !!}
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">推荐类型</label>
                            <div class="layui-input-block">
                                {!! Form::checkbox('is_top',0,isset($f_data)&&$f_data->is_top == 1 ? 'checked' : '',['class'=>'layui-input','title'=>'置顶','lay-skin'=>"primary"]) !!}
                                {!! Form::checkbox('is_tuijian',0,isset($f_data)&&$f_data->is_tuijian == 1 ? 'checked' : '',['class'=>'layui-input','title'=>'推荐','lay-skin'=>"primary"]) !!}
                                {!! Form::checkbox('is_hot',0,isset($f_data)&&$f_data->is_hot == 1 ? 'checked' : '',['class'=>'layui-input','title'=>'热门','lay-skin'=>"primary"]) !!}
                                {!! Form::checkbox('is_slide',0,isset($f_data)&&$f_data->is_slide == 1 ? 'checked' : '',['class'=>'layui-input','title'=>'幻灯','lay-skin'=>"primary"]) !!}
                            </div>
                        </div> -->

                       <!-- <div class="layui-form-item">
                            <label class="layui-form-label">颜色</label>
                            <div class="layui-input-inline" style="width: 120px;">
                                {!! Form::input('text','color',old('color'),['class'=>'layui-input app-cate-color','placeholder'=>'请选择颜色']) !!}
                            </div>
                            <div class="layui-inline" style="left: -11px;margin-bottom: 0">
                                <div id="test-form"></div>
                            </div>
                        </div> -->

                        {{--<div class="layui-form-item">--}}
                            {{--<label class="layui-form-label">封面图片</label>--}}
                            {{--<div class="layui-input-inline">--}}
                                {{--{!! Form::input('text','thumb',old('thumb'),['class'=>'layui-input app-block-img','autocomplete'=>'off']) !!}--}}
                            {{--</div>--}}
                            {{--<a class="layui-btn" id="upload-avatar"><i class="fa fa-upload"></i>上传图片</a>--}}
                        {{--</div>--}}
                        @include('backend.common._field_data')
                        {{--<div class="layui-form-item">--}}
                            {{--<label class="layui-form-label">摘要</label>--}}
                            {{--<div class="layui-input-block">--}}
                                {{--<div class="layui-col-md4">--}}
                                    {{--{!! Form::textarea('summary',old('summary'),['class'=>'layui-textarea','rows'=>'2']) !!}--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="layui-form-item">--}}
                            {{--<label class="layui-form-label">内容详情</label>--}}

                            {{--<div class="layui-input-block">--}}
                                {{--<!-- 编辑器容器 -->--}}
                                {{--<script id="container" name="description" value="description" type="text/plain">--}}
                                    {{--@if(isset($f_data))--}}
                                        {{--{!! $f_data->description !!}--}}
                                    {{--@endif--}}
                                {{--</script>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="layui-form-item">
                            <label class="layui-form-label">是否显示</label>
                            <div class="layui-input-block">
                                {!! Form::radio('is_show',1,true,['title'=>'显示']) !!}
                                {!! Form::radio('is_show',0,false,['title'=>'隐藏']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">允许评论</label>
                            <div class="layui-input-block">
                                {!! Form::radio('is_comment',1,true,['title'=>'允许']) !!}
                                {!! Form::radio('is_comment',0,false,['title'=>'不允许']) !!}
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
                            <label class="layui-form-label">跳转网站</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','url',old('url'),['class'=>'layui-input','autocomplete'=>'off']) !!}
                            </div>
                            <button style="margin-left: 10px;" class="layui-btn layui-btn-primary app-tip-info" data-content="请输入完整的URL网址（包含http或https），设置后访问该条信息将直接跳转到设置的网址" onmouseover="layer_tips = layer.tips(this.getAttribute('data-content'), this, {time:100000});" onmouseleave="layer.close(layer_tips);">
                                <i class="fa fa-info-circle"></i>
                            </button>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">标签</label>
                            <div class="layui-input-inline">
                                <select name="tags" xm-select="select6_1" xm-select-skin="default">
                                    @foreach($tags as $v)
                                        <option value="{{$v->id}}" {{isset($f_data) && (in_array($v->id,collect($f_data->tags->pluck('id'))->toArray())) ? 'selected' : ''}}>
                                            {{$v->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--<div class="layui-form-item">--}}
                            {{--<label class="layui-form-label">作者</label>--}}
                            {{--<div class="layui-input-inline">--}}
                                {{--{!! Form::input('text','author',old('author'),['class'=>'layui-input','autocomplete'=>'off']) !!}--}}
                            {{--</div>--}}
                        {{--</div>--}}
                       <!-- <div class="layui-form-item">
                            <label class="layui-form-label">來源</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','source',old('source'),['class'=>'layui-input','autocomplete'=>'off']) !!}
                            </div>
                        </div> -->
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
                                    {!! Form::input('text','views',isset($f_data) && $f_data->views != 0 ? $f_data->views : 0,['class'=>'layui-input','lay-verify'=>'number','placeholder'=>'',"onkeyup"=>"value=value.replace(/[^0-9\.]/g,'')"]) !!}
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
{{--@include('vendor.ueditor.assets')--}}
@section('script')
    <script src="{{asset('backend/plugins/BaiDuTranslate/md5.js')}}"></script>
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
        layui.use(['jquery','form','colorpicker','laydate','upload','formSelects'],function () {
            var $ = layui.$;
            var form = layui.form;
            var colorpicker = layui.colorpicker;
            var laydate= layui.laydate;
            var upload=layui.upload;
            var formSelects = layui.formSelects;

            formSelects.value('select6_1');


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

            colorpicker.render({
                elem: '#test-form' //绑定元素
                ,change: function(color){ //颜色改变的回调
                    layer.tips('选择了：'+ color, this.elem, {
                        tips: 1
                    });
                    $('.app-cate-color').val(color);
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


        });
    </script>

@stop
