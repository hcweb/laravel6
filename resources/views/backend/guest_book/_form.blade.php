<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-form"
                 style="padding: 0;">
                @if(isset($category))
                    {!! Form::model($category,['url'=>'admin/category/'.$category->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                    <input type="hidden" name="categoryId" value="{{$category->id}}">
                @else
                    {!! Form::open(['route'=>'category.store','class'=>'form-horizontal']) !!}
                @endif
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <ul class="layui-tab-title">
                    <li class="layui-this">基本信息</li>
                    <li>内容设置</li>
                    <li>SEO</li>
                    <li>模板管理</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form-item">
                            <label class="layui-form-label">父类</label>
                            <div class="layui-input-inline">
                                {{--lay-verify="required"--}}
                                <select name="parent_id">
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
                        <div class="layui-form-item">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>栏目类型</label>
                            <div class="layui-input-inline">
                                <select name="mould_id" lay-verify="required" id="app-category-mould" lay-filter="mould_type">
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
                        <div class="layui-form-item">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>标题</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','title',old('title'),['class'=>'layui-input category-title','placeholder'=>'请输入标题','lay-verify'=>'required','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>调用别名</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','alias',old('alias'),['class'=>'layui-input category-alias','placeholder'=>'不输入则自动翻译','lay-verify'=>'required','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">字体样式</label>
                            <div class="layui-input-inline">
                                {!! Form::checkbox('font_style[]',0,isset($category) && str_contains($category->font_style,'0') ? 'checked' : '',['class'=>'layui-input','title'=>'加粗','lay-skin'=>"primary"]) !!}
                                {!! Form::checkbox('font_style[]',1,isset($category) && str_contains($category->font_style,'1') ? 'checked' : '',['class'=>'layui-input','title'=>'倾斜','lay-skin'=>"primary"]) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">打开方式</label>
                            <div class="layui-input-block">
                                {!! Form::radio('target','_self','checked',['title'=>'本页打开']) !!}
                                {!! Form::radio('target','_blank','checked',['title'=>'新窗体中打开']) !!}
                                {!! Form::radio('target','_parent','checked',['title'=>'父窗体中打开']) !!}
                            </div>
                        </div>


                        <div class="layui-form-item">
                            <label class="layui-form-label">图标</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','icon_class',old('icon_class'),['class'=>'layui-input','placeholder'=>'请输入字体图标','autocomplete'=>'off']) !!}
                            </div>
                            {{--<span class="layui-btn layui-btn-primary app-form-tip" style="border:none !important;" title="如fa fa-home"><i class="fa fa-info-circle"></i></span>--}}
                            <div class="layui-form-mid layui-word-aux">如fa fa-home</div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">颜色</label>
                            <div class="layui-input-inline" style="width: 120px;">
                                {!! Form::input('text','color',old('color'),['class'=>'layui-input app-cate-color','placeholder'=>'请选择颜色']) !!}
                            </div>
                            <div class="layui-inline" style="left: -11px;margin-bottom: 0">
                                <div id="test-form"></div>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">排序</label>
                            <div class="layui-input-inline">
                                <div class="layui-col-md4">
                                    {!! Form::input('text','order',0,['class'=>'layui-input','lay-verify'=>'number','placeholder'=>'']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">是否显示</label>
                            <div class="layui-input-block">
                                {!! Form::radio('is_show',1,true,['title'=>'显示']) !!}
                                {!! Form::radio('is_show',0,false,['title'=>'隐藏']) !!}
                            </div>
                        </div>
                    </div>
                    {{--内容设置--}}
                    <div class="layui-tab-item">
                        <div class="layui-form-item">
                            <label class="layui-form-label">URL链接</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','url',old('url'),['class'=>'layui-input','autocomplete'=>'off']) !!}
                            </div>
                            <div class="layui-form-mid layui-word-aux">填写后直接跳转到指定地址</div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">栏目图片</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','thumb',old('thumb'),['class'=>'layui-input app-block-img','autocomplete'=>'off']) !!}
                            </div>
                            <a class="layui-btn" id="upload-avatar"><i class="fa fa-upload"></i>上传图片</a>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">资料内容</label>

                            <div class="layui-input-block">
                                <!-- 编辑器容器 -->
                                <script id="container" name="description" value="description" type="text/plain">
                                    @if(isset($category))
                                        {!! $category->description !!}
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
                    {{--模板管理--}}
                    <div class="layui-tab-item">
                        <div class="layui-form-item" id="template_list">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>列表模板</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','template_list',old('template_list'),['class'=>'layui-input','autocomplete'=>'off','lay-verify'=>'required']) !!}
                            </div>
                            <div class="layui-form-mid layui-word-aux">请填写文件名不带php,例如list.blade.php写成list,如果带路径比如post/list.blade.php写成post.list</div>
                        </div>
                        <div class="layui-form-item" id="template_show">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>内容模板</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','template_show',old('template_show'),['class'=>'layui-input','autocomplete'=>'off','lay-verify'=>'required']) !!}
                            </div>
                            <div class="layui-form-mid layui-word-aux">请填写文件名不带php,例如show.blade.php写成list,如果带路径比如post/show.blade.php写成post.show</div>
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
</div>
@include('vendor.ueditor.assets')
@section('script')
    <script src="{{asset('backend/plugins/BaiDuTranslate/md5.js')}}"></script>
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
        layui.use(['jquery','form','colorpicker'],function () {
            var $ = layui.$;
            var form = layui.form;
            var colorpicker = layui.colorpicker;

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


            form.on('select(mould_type)', function(data){
                getMouldName(data);
            });

            function getMouldName(data) {
                var url="{{url('admin/get_mould_name')}}"+"/"+data.value;
                $.get(url,function (response) {
                    setDefaulTemplaye(data.value,response.data);
                });
            }

            function setDefaulTemplaye(value,template){
                alert(value+"--"+template);
                var index=parseInt(value);
                if (index == 4 || index == 5){
                    $('#template_list').hide();
                    $('input[name=template_show]').val('view_'+template+'.blade.php');
                }else{
                    $('#template_list').show();
                    $('input[name=template_list]').val('list_'+template+'.blade.php');
                    $('input[name=template_show]').val('view_'+template+'.blade.php');
                }
            }

            colorpicker.render({
                elem: '#test-form' //绑定元素
                ,change: function(color){ //颜色改变的回调
                    layer.tips('选择了：'+ color, this.elem, {
                        tips: 1
                    });
                    $('.app-cate-color').val(color);
                }
            });

            $('.app-form-tip').mouseenter(function () {
                layer.tips('如fa fa-home',$(this), {tips: 1});
            });

            //百度翻譯
            function translate($query) {
                $.get('/translate/' + $query, function (response) {
                    if (response.success == true) {
                        $(".category-alias").val(response.data);
                    }
                });
            };
        });
    </script>
@stop
