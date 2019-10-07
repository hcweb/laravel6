@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        #user-avatar {
            position: absolute;
            width: 150px;
            height: 220px;
            right: 35px;
            top: 35px;
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
<div class="row">
    <div class="col-12">
        <div class="card-box position-relative">
            @if(isset($user))
                {!! Form::model($user,['url'=>'admin/user/'.$user->id,'class'=>'form-horizontal']) !!}
                {{method_field('PUT')}}
                <input type="hidden" name="userId" value="{{$user->id}}">
            @else
                {!! Form::open(['route'=>'user.store','class'=>'form-horizontal']) !!}

            @endif
            {!! Form::hidden('avatar',old('avatar')) !!}
                <div class="row form-group">
                    <label class="col-sm-12 col-md-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>角色</label>
                    <div class="col-sm-3">
                        <select name="role" class="form-control select2">
                            <option value="">请选择角色</option>
                            @foreach($roles as $v)
                                <option
                                    value="{{$v->name}}" {{isset($user) && ($user->getRoleNames()->contains($v->name)) ? 'selected' : ''}}>{{$v->display_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>用户名</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入用户名','lay-verify'=>'required','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-12 col-md-1 col-form-label text-right">手机号码</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','tel',old('tel'),['class'=>'form-control','placeholder'=>'请输入手机','lay-verify'=>'required|phone','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-12 col-md-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>邮箱</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','email',old('email'),['class'=>'form-control','placeholder'=>'请输入邮箱','lay-verify'=>'required|email','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-12 col-md-1 col-form-label text-right">真实姓名</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','real_name',old('real_name'),['class'=>'form-control','placeholder'=>'请输入真实姓名','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-12 col-md-1 col-form-label text-right">密码</label>
                    <div class="col-sm-3">
                        {!! Form::input('password','password',isset($user)?'0|0|0|0':'',['class'=>'form-control','lay-verify'=>'required','placeholder'=>'请输入密码','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-12 col-md-1 col-form-label text-right">确认密码</label>
                    <div class="col-sm-3">
                        {!! Form::input('password','password_confirmation',isset($user)?'0|0|0|0':'',['class'=>'form-control','lay-verify'=>'required','placeholder'=>'请输入确认密码','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-12 col-md-1 col-form-label text-right">是否可用</label>
                    <div class="col-sm-12 col-md-6 d-flex align-items-center">
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('is_enabled',1,true,['class'=>'custom-control-input','id'=>'customRadio1']) !!}
                            <label class="custom-control-label font-weight-normal" for="customRadio1">可用</label>
                        </div>
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('is_enabled',0,false,['class'=>'custom-control-input','id'=>'customRadio2']) !!}
                            <label class="custom-control-label font-weight-normal" for="customRadio2">禁用</label>
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
                <div id="user-avatar">
                    <div class="user-avatar-img">
                        <img src="{{asset('backend/images/default.jpg')}}" alt="" id="user_avatar" onerror="this.src='{{asset("backend/images/default.jpg")}}'">
                    </div>
                    <div class="app-file-upload-btn">
                        <a class="btn btn-secondary btn-block mt-2" id="upload-avatar" style="color: #ffffff;"><i class="fa fa-upload"></i>上传图片</a>
                    </div>
                </div>
        </div>
    </div>
</div>



@section('script')
    <script src="{{asset('backend/assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
            var upload = layui.upload;

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

                },
                error: function(index, upload){
                    //请求异常回调

                }
            });

    </script>
@stop
