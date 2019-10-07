<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title','锦茂数字图书馆-医学版')</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="author" content="CodedThemes"/>
    <link rel="icon" href="{{asset('backend/images/favicon.ico')}}" type="image/x-icon">
    <!-- App css -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/libs/jquery-toast/jquery.toast.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        #captcha-box {
            position: relative;
            padding-right: 100px;
        }

        #captcha-box img {
            position: absolute;
            width: 90px !important;
            right: 0;
            top: 0;
            height: 36px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <a href="index.html">
                                <span>
                                     <img style="width: 150px;" src="{{config('system_config.site_logo')}}"
                                          onerror="javascript:this.src='{{asset('backend/assets/images/logo.png')}}';"
                                          alt="">
                                </span>
                            </a>
                            <p class="text-muted mb-4 mt-3">{{config('system_config.site_alias')}}</p>
                        </div>

                        {!! Form::open(['url'=>'admin/loginForm','class'=>'','id'=>'loginform']) !!}
                        <div class="form-group mb-3">
                            <input type="text" name="username"
                                   class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}"
                                   value="{{old('username')}}" placeholder="请输入用户名或邮箱">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password"
                                   class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}"
                                   placeholder="请输入密码">
                        </div>
                        <div class="form-group mb-3">
                            <div id="captcha-box">
                                <input type="text" name="captcha"
                                       class="form-control {{$errors->has('captcha') ? 'is-invalid' : ''}}"
                                       placeholder="请输入验证码">
                                <img src="{{ captcha_src('default') }}" alt=""
                                     onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="rember_me" class="custom-control-input"
                                       id="checkbox-signin" checked>
                                <label class="custom-control-label" for="checkbox-signin">记住密码</label>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block btn-lg" type="submit">登录</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="{{asset('backend/assets/libs/jquery-toast/jquery.toast.min.js')}}"></script>
<script>
    $(function () {
            @if(count($errors)>0)
                let errorInfo = '';
                @foreach($errors->all() as $error)
                    errorInfo += '<p>{{$error}}</p>';
                @endforeach
                $.toast({
                    text: errorInfo,
                    position: 'top-center',
                    stack: false,
                    loaderBg: '#f1556c',
                    icon: 'error'
                });
                @endif
    })
</script>
</body>
</html>


