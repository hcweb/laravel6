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
		body{background: #00BCD2;}
      .videosamplex{width:100%;height:100vh;display: flex;justify-content: center;align-items: center;}
    </style>
</head>
<body>
<div class="videosamplex">
    <audio controls="controls" src="{{$path}}" controls="controls" autoplay="autoplay">

    </audio>
</div>
</body>
</html>
