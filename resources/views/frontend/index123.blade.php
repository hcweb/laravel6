<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{config('system_config.site_title')}}</title>
    <meta name="Keywords" content="{{config('system_config.site_keywords')}}" />
    <meta name="Description" content="{{config('system_config.site_description')}}"/>

    <link rel="stylesheet" href="{{asset('frontend/bt400/css/pubstyle.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/bt400/css/index.css')}}">
    <script src="{{asset('frontend/bt400/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('frontend/layui/layui.all.js')}}"></script>
    <script src="{{asset('frontend/bt400/js/pubtx.js')}}"></script>

</head>
<body>
<!-- 网站体 -->
<div class="wrapper">

<!-- 网站头部 -->
<div class="top">
    <div class="left">
        <h1>{{config('system_config.site_alias')}}</h1>
    </div>
    <div class="right">
        <a href="JavaScript:;" id="topbtn1">登录</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="JavaScript:;" id="topbtn2">注册</a>&nbsp;&nbsp;&nbsp;&nbsp;
        <!--               <a href="JavaScript:;" id="topbtn111">设为首页</a>&nbsp;&nbsp;&nbsp;&nbsp;
                      <a href="JavaScript:;" id="topbtn222">收藏本页</a>&nbsp;&nbsp;&nbsp;&nbsp; -->
    </div>
    <div class="fclear"></div>
</div>

<!-- 网站内容 -->
<div class="content">
    <div class="logo"><img src="{{config('system_config.site_logo')}}" alt=""></div>

    <div class="forms">
        <span>
            <?php
            $types=['vods','ppts','pics','tests','softs'];
            ?>
            @foreach($categories as $v)
                @if ($loop->last)
                        <a href="JavaScript:;" class="{{$types[count($types)-1]}}">{{$v->title}}</a>
                    @else
                    <a href="JavaScript:;" class="{{$types[$loop->index]}}">{{$v->title}}</a>&nbsp;&nbsp;&nbsp;
                @endif
            @endforeach
        </span>
        <input type="text" name="searchname" placeholder="" class='inxsearch'>
        <input type="submit" class="s_btn" name="s_btn" value="" >
        <div class='searchway'>
               <span>
                 <label>
                  <input type="radio" name='field1' checked="checked"> 书名
                 </label>
                 <label>
                  <input type="radio" name='field1'> 作者
                 </label>
                 <label>
                  <input type="radio" name='field1'> 分类号
                 </label>
                 <label>
                  <input type="radio" name='field1'> ISBN
                 </label>
                 <label>
                  <input type="radio" name='field1'> 摘要
                 </label>
               </span>

            <span>
                 <label>
                  <input type="radio" name='field2' checked="checked"> 标题
                 </label>
                 <label>
                  <input type="radio" name='field2'> 作者
                 </label>
                 <label>
                  <input type="radio" name='field2'> 来源
                 </label>
                 <label>
                  <input type="radio" name='field2'> 摘要
                 </label>
                 <label>
                  <input type="radio" name='field2'> 综合
                 </label>
               </span>

            <span>
                 <label>
                  <input type="radio" name='field3' checked="checked"> 名称
                 </label>
                 <label>
                  <input type="radio" name='field3'> 综合
                 </label>
               </span>
        </div>

    </div>
    <div class="colnav">
        @foreach($categories as $v)
            <span>
                <a href="#">{{$v->title}}</a>
            </span>
        @endforeach
    </div>
</div>
<div class="fclear"></div>
<!-- 网站底部 -->
<div class="bottom">
    <div class="blink">
        <a href="{{route('home.page',['alias'=>'contact_us'])}}">联系我们</a><span>&nbsp;|&nbsp;</span>
        <a href="JavaScript:;">意见建议</a><span>&nbsp;|&nbsp;</span>
        <a href="{{route('home.page',['alias'=>'help'])}}">使用帮助</a><span>&nbsp;|&nbsp;</span>
        <a href="{{route('home.tool')}}">工具软件</a>
    </div>
    <div class="bcopy">{{config('system_config.site_copyright')}}</div>

</div>
</div>

<!-- 用户注册 -->
<div id="userreg">
    <div class="ditem">
        <input type="text"  id="UserName" placeholder="请输入用户名"/>
    </div>
    <div class="ditem">
        <input type="password" id="Pwd"  placeholder="请输入密码"/>
    </div>
    <div class="ditem">
        <input type="password" id="sPwd"  placeholder="确认密码"/>
    </div>
    <div class="ditem">
        <input type="password" id="mobile"  placeholder="手机号"/>
    </div>
    <div class="ditem">
        <input class='yzbh' type="picCode" id="txtPwd"  placeholder="图形验证码"/>
    </div>
    <div class="ditem">
        <input  class='yzbh'  type="smsCode" id="txtPwd"  placeholder="短信验证码"/>&nbsp;&nbsp;<span>获取短信验证码</span>
    </div>
    <div class="ditem"><a href="javascript:;">下一步</a></div>
</div>
</body>
</html>
