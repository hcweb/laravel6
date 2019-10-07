@section('css')
    <style>
        #user-avatar {
            position: fixed;
            width: 150px;
            height: 220px;
            right: 35px;
            top: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #user-avatar .user-avatar-img {
            width: 130px;
            padding: 5px;
            border: 1px solid #EEEEEE;
            background: #fff;
            height: 150px;
        }

        #user-avatar .user-avatar-img img {
            width: 100%;
            height: 100%;
        }

        #user-avatar button {
            margin-top: 20px;
        }
    </style>
@stop
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="layui-form" lay-filter="layuiadmin-form-useradmin" id="layuiadmin-form-useradmin"
                 style="padding: 20px 0 0 0;">
                @if(isset($member))
                    {!! Form::model($member,['url'=>'admin/member/'.$member->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                    <input type="hidden" name="memberId" value="{{$member->id}}">
                @else
                    {!! Form::open(['route'=>'member.store','class'=>'form-horizontal']) !!}

                @endif
                {!! Form::hidden('avatar',old('avatar')) !!}
                <div class="layui-form-item">
                    <label class="layui-form-label"><i
                            style="color: red;display: inline-block;width: 20px;"></i><i style="color: red;margin-right: 10px;">*</i>用户名</label>
                    <div class="layui-input-inline">
                        {!! Form::input('text','name',old('name'),['class'=>'layui-input','placeholder'=>'请输入用户名','lay-verify'=>'required','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机号码</label>
                    <div class="layui-input-inline">
                        {!! Form::input('text','tel',old('tel'),['class'=>'layui-input','placeholder'=>'请输入手机','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱</label>
                    <div class="layui-input-inline">
                        {!! Form::input('text','email',old('email'),['class'=>'layui-input','placeholder'=>'请输入邮箱','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>密码</label>
                    <div class="layui-input-inline">
                        {!! Form::input('password','password',isset($member)?'0|0|0|0':'',['class'=>'layui-input','lay-verify'=>'required','placeholder'=>'请输入密码','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label"><i style="color: red;margin-right: 10px;">*</i>确认密码</label>
                    <div class="layui-input-inline">
                        {!! Form::input('password','password_confirmation',isset($member)?'0|0|0|0':'',['class'=>'layui-input','lay-verify'=>'required','placeholder'=>'请输入确认密码','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">是否可用</label>
                    <div class="layui-input-block">
                        {!! Form::radio('is_enabled',1,true,['title'=>'可用']) !!}
                        {!! Form::radio('is_enabled',0,false,['title'=>'禁用']) !!}
                    </div>
                </div>
                <div class="layui-form-item layui-hide">
                    <input type="submit" value="确认" lay-submit id="LAY-user-front-submit">
                </div>
                <div id="user-avatar">
                    <div class="user-avatar-img">
                        <img src="{{asset('backend/images/default.jpg')}}" alt="" id="user_avatar" onerror="this.src='{{asset("backend/images/default.jpg")}}'">
                    </div>
                    <button class="layui-btn" type="button" id="upload-avatar"><i class="fa fa-upload"
                                                                            style="font-size: 12px !important;"></i>上传图像
                    </button>
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
@section('script')
    <script>
        layui.use(['jquery','upload','form'],function () {
            var $ = layui.$;
            var upload = layui.upload;
            var form = layui.form;

            $(function () {
                var imgPath=$("input[name=avatar]").val();
                if (imgPath != ''){
                    $("#user_avatar").attr('src', imgPath);
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
                    $("#user_avatar").attr('src', res.data.fullPath);
                    $("input[name=avatar]").val(res.data.path);
                    layer.msg(res.msg, {icon: 6});
                },
                error: function(index, upload){
                    //请求异常回调
                    layer.msg("上传失败！", {icon: 5});
                }
            });

        });
    </script>
@stop
