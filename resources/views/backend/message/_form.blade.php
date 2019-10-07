@section('css')
    <style>
        .layui-form-item .layui-form-checkbox[lay-skin="primary"]{margin-top: 0 !important;}
    </style>
@stop
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin"
                 style="padding: 20px 0 0 0;">
                @if(isset($message))
                    {!! Form::model($message,['url'=>'admin/message/'.$message->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                @endif
                <div class="layui-row">
                    <div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-inline">
                            {!! Form::input('text','name',old('name'),['class'=>'layui-input','placeholder'=>'请输入姓名','lay-verify'=>'required','autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">邮箱</label>
                        <div class="layui-input-inline">
                            {!! Form::input('text','email',old('email'),['class'=>'layui-input','placeholder'=>'请输入邮箱','lay-verify'=>'required','autocomplete'=>'off']) !!}
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">手机号</label>
                        <div class="layui-input-inline">
                            {!! Form::input('text','phone',old('phone'),['class'=>'layui-input','placeholder'=>'请输入手机号','autocomplete'=>'off']) !!}
                        </div>
                    </div>
                    <div class="layui-col-md4">
                        <div class="layui-form-item">
                            <label class="layui-form-label">留言内容</label>
                            <div class="layui-input-block">
                                {!! Form::textarea('content',old('content'),['class'=>'layui-textarea','rows'=>3]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="layui-clear"></div>
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
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        layui.use(['jquery', 'form'], function () {
            var $ = layui.$;
            var form = layui.form;
        });
    </script>
@stop
