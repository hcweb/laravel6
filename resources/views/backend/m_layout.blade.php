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
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App css -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/libs/jquery-toast/jquery.toast.min.css')}}" rel="stylesheet" type="text/css"/>
    @yield('css')
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        body.enlarged{min-height: auto !important;}
    </style>
    <style>
        body{background: #ffffff;}
    </style>
    <script src="{{asset('backend/assets/libs/sortable/Sortable.min.js')}}"></script>
    <script>
        window.hbidea = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('t-script')
</head>

<body>

<!-- Start Content-->
<div class="container-fluid pl-0 pr-0">
    @yield('content')
</div> <!-- container -->

<!-- Vendor js -->
<script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/jquery-toast/jquery.toast.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('backend/assets/js/layui.all.js')}}"></script>

<script>
$(document).ready(function () {
@if ($errors->any())
    var errors ='';
    @foreach($errors->all() as $e)
        errors+='<p class="mb-0" style="color:rgba(0,0,0,.64);font-size:16px;">{{$e}}</p>';
    @endforeach
    var errorBox = document.createElement("div");
    errorBox.innerHTML=errors;
    swal({
        icon: "error",
        timer: '2000',
        button:false,
        content: errorBox
    });
    // $.toast({
    // text: errors,
    // position: 'top-center',
    // loaderBg: '#ff6849',
    // icon: 'error'
    // });
@endif
@if (session()->has('successMsg'))
    var msg = "{{session()->get('successMsg')}}";
    swal({
        text: msg,
        icon: "success",
        timer: '2000',
        button:false
    });
    // $.toast({
    // text: msg,
    // position: 'top-center',
    // loaderBg: '#1abc9c',
    // icon: 'success'
    // });
@endif
});
</script>
@yield('script')
<script src="{{asset('backend/assets/js/app.min.js')}}"></script>
<script src="{{asset('backend/assets/js/hbcms.js')}}"></script>
</body>
</html>

