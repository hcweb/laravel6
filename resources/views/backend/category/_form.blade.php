@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(isset($category))
                {!! Form::model($category,['url'=>'admin/category/'.$category->id,'class'=>'form-horizontal']) !!}
                {{method_field('PUT')}}
                <input type="hidden" name="categoryId" value="{{$category->id}}">
            @else
                {!! Form::open(['route'=>'category.store','class'=>'form-horizontal']) !!}
            @endif
            <ul class="nav nav-tabs nav-bordered">
                <li class="nav-item">
                    <a href="#base" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                        <span class="d-none d-sm-inline-block">基本信息</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#content" data-toggle="tab" aria-expanded="true" class="nav-link">
                        <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                        <span class="d-none d-sm-inline-block">内容设置</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#seo" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-inline-block">SEO</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#template" data-toggle="tab" aria-expanded="false" class="nav-link">
                        <span class="d-inline-block d-sm-none"><i class="fas fa-cog"></i></span>
                        <span class="d-none d-sm-inline-block">模板管理</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active show" id="base">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>父类</label>
                        <div class="col-sm-12 col-md-3">
                            <select name="parent_id" class="form-control select2">
                                <option value="">顶级栏目</option>
                                @foreach($categorys as $v)
                                    @if(!is_null(request()->get('id')))
                                        <option value="{{$v['id']}}" {{request()->get('id') == $v['id'] ? 'selected' : ''}}>{{$v['depth'] != 0 ? '|' : ''}}{{str_repeat('-',$v['depth']*3)}}{{$v['title']}}</option>
                                    @else
                                        <option value="{{$v['id']}}" {{isset($category) && ($category->parent_id == $v['id']) ? 'selected' : ''}}>{{$v['depth'] != 0 ? '|' : ''}}{{str_repeat('-',$v['depth']*3)}}{{$v['title']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>栏目类型</label>
                        <div class="col-sm-3">
                            <select name="mould_id"  id="app-category-mould" class="form-control select2">
                                @if (isset($moulds))
                                    @foreach($moulds as $v)
                                        @if(!is_null(request()->get('mid')))
                                            <option value="{{$v->id}}" {{request()->get('mid') == $v->id ? 'selected' : ''}} data-table="{{$v->table_name}}">{{$v->name}}</option>
                                        @else
                                            <option value="{{$v->id}}" {{isset($category) && ($category->mould_id == $v->id) ? 'selected' : ''}} data-table="{{$v->table_name}}">{{$v->name}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>标题</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','title',old('title'),['class'=>'form-control category-title','placeholder'=>'请输入标题','autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>调用别名</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','alias',old('alias'),['class'=>'form-control category-alias','placeholder'=>'不输入则自动翻译','autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-12 col-md-1 col-form-label text-right">字体样式</label>
                        <div class="col-sm-12 col-md-6 d-flex align-items-center">
                            <div class="custom-control custom-checkbox pr-2">
                                {!! Form::checkbox('font_style[]',0,isset($category) && Str::contains($category->font_style,'0') ? 'checked' : '',['class'=>'custom-control-input','id'=>'customRadio1']) !!}
                                <label class="custom-control-label font-weight-normal" for="customRadio1">加粗</label>
                            </div>
                            <div class="custom-control custom-checkbox pr-2">
                                {!! Form::checkbox('font_style[]',1,isset($category) && Str::contains($category->font_style,'1') ? 'checked' : '',['class'=>'custom-control-input','id'=>'customRadio2']) !!}
                                <label class="custom-control-label font-weight-normal" for="customRadio2">倾斜</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-12 col-md-1 col-form-label text-right">打开方式</label>
                        <div class="col-sm-12 col-md-6 d-flex align-items-center">
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('target','_self','checked',['class'=>'custom-control-input','id'=>'t_customRadio1']) !!}
                                <label class="custom-control-label font-weight-normal" for="t_customRadio1">本页打开</label>
                            </div>
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('target','_blank','checked',['class'=>'custom-control-input','id'=>'t_customRadio2']) !!}
                                <label class="custom-control-label font-weight-normal" for="t_customRadio2">新窗体中打开</label>
                            </div>
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('target','_parent','checked',['class'=>'custom-control-input','id'=>'t_customRadio3']) !!}
                                <label class="custom-control-label font-weight-normal" for="t_customRadio3">父窗体中打开</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">图标</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','icon_class',old('icon_class'),['class'=>'form-control','placeholder'=>'请输入字体图标','autocomplete'=>'off']) !!}
                        </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">如fa fa-home.</small>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">字体颜色</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','color',old('color'),['class'=>'form-control app-cate-color','placeholder'=>'请选择字体颜色','autocomplete'=>'off','id'=>'app-cate-color']) !!}

                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">排序</label>
                        <div class="col-sm-1">
                            {!! Form::input('text','order',isset($category)?old('order'):0,['class'=>'form-control','placeholder'=>'']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-12 col-md-1 col-form-label text-right">是否显示</label>
                        <div class="col-sm-12 col-md-6 d-flex align-items-center">
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
                <div class="tab-pane fade" id="content">
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">URL连接</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','url',old('url'),['class'=>'form-control','autocomplete'=>'off']) !!}
                        </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">填写后直接跳转到指定地址.</small>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">栏目图片</label>
                        <div class="col-sm-11">
                            <div class="row">
                                <div class="col-sm-4">
                                    {!! Form::input('text','thumb',old('thumb'),['class'=>'form-control app-block-img','autocomplete'=>'off']) !!}
                                </div>
                                <div class="app-file-upload-btn">
                                    <a class="btn btn-secondary" id="upload-avatar" style="color: #ffffff;"><i class="fa fa-upload"></i>上传图片</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">资料内容</label>
                        <div class="col-sm-11">
                            <!-- 编辑器容器 -->
                            <script id="container" name="description" value="description" type="text/plain">
                                @if(isset($category))
                                    {!! $category->description !!}
                                @endif
                            </script>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="seo">
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">SEO标题</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','seo_title',old('seo_title'),['class'=>'form-control','autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">SEO关键字</label>
                        <div class="col-sm-8">
                            {!! Form::textarea('seo_key',old('seo_key'),['class'=>'form-control','rows'=>'3']) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right">SEO描述</label>
                        <div class="col-sm-8">
                            {!! Form::textarea('seo_content',old('seo_content'),['class'=>'form-control','rows'=>'3']) !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="template">
                    <div class="form-group row" id="template_list">
                        <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>列表模板</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','template_list',old('template_list'),['class'=>'form-control','autocomplete'=>'off']) !!}
                        </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">请填写文件名不带php,例如list.blade.php写成list,如果带路径比如post/list.blade.php写成post.list.</small>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>内容模板</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','template_show',old('template_show'),['class'=>'form-control','autocomplete'=>'off']) !!}
                        </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">请填写文件名不带php,例如show.blade.php写成list,如果带路径比如post/show.blade.php写成post.show.</small>
                    </div>
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
@section('script')
    <script src="{{asset('backend/plugins/BaiDuTranslate/md5.js')}}"></script>
    <script src="{{asset('backend/assets/libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
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

        $('#app-cate-color').colorpicker({
            format:'hex'
        });
        $(".select2").select2();

            var upload = layui.upload;

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
                    $(".app-block-img").val(res.data.path);

                    layer.msg(res.msg, {icon: 6});
                },
                error: function (index, upload) {
                    //请求异常回调
                    layer.msg("上传失败！", {icon: 5});
                }
            });

            $(".category-title").blur(function () {
                if ($(this).val() != '') {
                    translate($(this).val());
                }
            });

           @empty($category)
            var url="{{url('admin/get_mould_name')}}"+"/"+$('#app-category-mould').val();
            $.get(url,function (response) {
                setDefaulTemplaye($('#app-category-mould').val(),response.data);
            });
            @endempty


            $("#app-category-mould").on("select2:select",function(){
                var data = $(this).val();
                getMouldName(data);
            });



            function getMouldName(data) {
                var url="{{url('admin/get_mould_name')}}"+"/"+data;
                $.get(url,function (response) {
                    setDefaulTemplaye(data,response.data);
                });
            }

            function setDefaulTemplaye(value,template){
                var index=parseInt(value);
                if (index == 4 || index == 5){
                    $('#template_list').hide();
                    $('#template_list').find('input').val('list_'+template+'.blade.php');
                    $('input[name=template_show]').val('view_'+template+'.blade.php');
                }else{
                    $('#template_list').show();
                    $('input[name=template_list]').val('list_'+template+'.blade.php');
                    $('input[name=template_show]').val('view_'+template+'.blade.php');
                }
            }


            //百度翻譯
            function translate($query) {
                $.get('/translate/' + $query, function (response) {
                    if (response.success == true) {
                        $(".category-alias").val(response.data);
                    }
                });
            };

    </script>
@stop
