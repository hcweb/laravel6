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
        iframe{position: absolute;width: 100%;height: 100%;}
    </style>
</head>
<body>
<iframe src="{{asset('frontend/pdfjs/web/viewer.html?file='.$path)}}" frameborder="0"></iframe>
</body>
</html>
