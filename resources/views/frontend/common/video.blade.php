<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('system_config.site_title')}}</title>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <style>
        html{overflow: hidden;}
        .videosamplex{width: 100%;height: 100vh;}
        #videoplayer{width: 100%;height: 100%;}
    </style>
</head>
<body>
<div class="videosamplex">
    <video id="videoplayer" src="{{$path}}"></video>
</div>
<script type="text/javascript" src="{{asset('frontend/ckplayer/ckplayer.min.js')}}"></script>
<script type="text/javascript">
    var videoObject = {
        container: '.videosamplex',//“#”代表容器的ID，“.”或“”代表容器的class
        variable: 'player',//该属性必需设置，值等于下面的new chplayer()的对象
        poster:'pic/wdm.jpg',
        mobileCkControls:true,//是否在移动端（包括ios）环境中显示控制栏
        mobileAutoFull:false,//在移动端播放后是否按系统设置的全屏播放
        h5container:'#videoplayer',//h5环境中使用自定义容器
        video:"{{$path}}"//视频地址
    };
    var player=new ckplayer(videoObject);
</script>
</body>
</html>
