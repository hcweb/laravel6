<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="Keywords" content="{{config('system_config.site_keywords')}}" />
    <meta name="Description" content="{{config('system_config.site_description')}}"/>
    <title>@yield('title',config('system_config.site_title'))</title>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/layer/theme/default/layer.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/login.css')}}">
</head>
<body>
<div class="container-fluid">
    <div class="app-login-box d-flex justify-content-center">
        <div class="col-md-5 col-sm-12">
            <div class="logincon">
                <div class="bd-example">
                    <h2 class="text-center">用户登录<small>Login</small></h2>
                    <form action="" name="loginform" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="validationTooltip01"></label>
                            <input type="text" class="form-control" id="validationTooltip01" placeholder="用户名" name="username" value="download">
                        </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1"></label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="password" value="123456">
                            </div>

                            <button type="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;登录&nbsp;&nbsp;&nbsp;</button>
                            <button type="reset" class="btn btn-warning">&nbsp;&nbsp;&nbsp;重置&nbsp;&nbsp;&nbsp;</button>
                            <span class="text-info">&nbsp;&nbsp;&nbsp;<small>默认账号密码，请直接点击登录按钮！</small></span>

                    </form>
                </div>
                <!--<h6 class="text-center" style="margin-top:180px;color:#999">锦茂数字图书馆 医学版 &copy; 2014-2019</h6>-->
                <h6 class="text-center" style="margin-top:180px;color:#999">{{config('system_config.site_copyright')}}</h6>

            </div>
        </div>
    </div>
</div>
<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/layer/layer.js')}}"></script>
<script>
        @if(count($errors)>0)
    var html='';
    @foreach($errors->all() as $error)
        html+='<p class="mb-0">{{$error}}</p>';
    layer.msg(html, {icon: 5,offset:'50px'});
    @endforeach
    @endif
    //信息提示
    @if(session('status'))
    layer.msg("{{session('status')}}", {icon: 6,offset:'50px'});
        @endif
        @if (session()->has('successMsg'))
    var msg = "{{session()->get('successMsg')}}";
    layer.msg(msg, {icon: 6,offset:'50px'});
    @endif
</script>
</body>
</html>
