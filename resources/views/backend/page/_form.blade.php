@section('css')
    <style>
        .layui-form-select dl{z-index: 9999;}
    </style>
@stop
<div class="layui-fluid">
<div class="layui-card" style="margin-bottom: 0;">
        {{--<div class="layui-card-header">--}}
            {{--{{isset($f_data)?'修改':'添加'}}单页--}}
        {{--</div>--}}
        <div class="layui-card-body" id="layui-card-body-content">
            <div class="layui-form"
                 style="padding: 0;">
                @if(isset($page))
                    {!! Form::model($page,['url'=>'admin/page/'.$page->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                    <input type="hidden" value="{{$page->alias}}" name="alias"/>
                @else
                    {!! Form::open(['route'=>'page.store','class'=>'form-horizontal']) !!}
                    <input type="hidden" value="{{request('alias')}}" name="alias"/>
                @endif
            <div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <div class="layui-form-item">
                            <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>标题</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','title',old('title'),['class'=>'layui-input category-title','placeholder'=>'请输入标题','lay-verify'=>'required','autocomplete'=>'off']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">发布时间</label>
                            <div class="layui-input-inline">
                                {!! Form::input('text','push_time',old('push_time'),['class'=>'layui-input','autocomplete'=>'off','id'=>'datetime']) !!}
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">内容详情</label>
                            <div class="layui-input-block">
                                <!-- 编辑器容器 -->
                                <script id="container" name="content" value="content" type="text/plain">
                                    @if(isset($page))
                                        {!! $page->content !!}
                                    @endif
                                </script>
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
        layui.use(['jquery','form','laydate'],function () {
            var $ = layui.$;
            var form = layui.form;
            var laydate= layui.laydate;

            laydate.render({
                elem: '#datetime'
                ,type: 'datetime'
                ,value:new Date()
            });
        });
    </script>

@stop
