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

    <script>
        window.hbidea = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    @yield('t-script')
</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
@include('backend.common._header')
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
@include('backend.common._left')
<!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">
                @include('backend.common.breadcrumb')
                @yield('content')
            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
    @include('backend.common._footer')
    <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

{{--<!-- Right Sidebar -->--}}
{{--<div class="right-bar">--}}
{{--    <div class="rightbar-title">--}}
{{--        <a href="javascript:void(0);" class="right-bar-toggle float-right">--}}
{{--            <i class="fe-x noti-icon"></i>--}}
{{--        </a>--}}
{{--        <h4 class="m-0 text-white">Settings</h4>--}}
{{--    </div>--}}
{{--    <div class="slimscroll-menu">--}}
{{--        <!-- User box -->--}}
{{--        <div class="user-box">--}}
{{--            <div class="user-img">--}}
{{--                <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme"--}}
{{--                     class="rounded-circle img-fluid">--}}
{{--                <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>--}}
{{--            </div>--}}

{{--            <h5><a href="javascript: void(0);">Nik G. Patel</a></h5>--}}
{{--            <p class="text-muted mb-0"><small>Admin Head</small></p>--}}
{{--        </div>--}}

{{--        <ul class="nav nav-pills bg-light nav-justified">--}}
{{--            <li class="nav-item">--}}
{{--                <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">--}}
{{--                    General--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a href="#messages1" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active">--}}
{{--                    Chat--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--        <div class="tab-content pl-3 pr-3">--}}
{{--            <div class="tab-pane" id="home1">--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col">--}}
{{--                        <h5 class="m-0 font-15">Notifications</h5>--}}
{{--                        <p class="text-muted"><small>Do you need them?</small></p>--}}
{{--                    </div> <!-- end col-->--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="custom-control custom-switch mb-2">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="tabswitch1">--}}
{{--                            <label class="custom-control-label" for="tabswitch1"></label>--}}
{{--                        </div>--}}
{{--                    </div> <!-- end col -->--}}
{{--                </div>--}}
{{--                <!-- end row-->--}}

{{--                <div class="row mb-2">--}}
{{--                    <div class="col">--}}
{{--                        <h5 class="m-0 font-15">API Access</h5>--}}
{{--                        <p class="text-muted"><small>Enable/Disable access</small></p>--}}
{{--                    </div> <!-- end col-->--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="custom-control custom-switch mb-2">--}}
{{--                            <input type="checkbox" class="custom-control-input" checked id="tabswitch2">--}}
{{--                            <label class="custom-control-label" for="tabswitch2"></label>--}}
{{--                        </div>--}}
{{--                    </div> <!-- end col -->--}}
{{--                </div>--}}
{{--                <!-- end row-->--}}

{{--                <div class="row mb-2">--}}
{{--                    <div class="col">--}}
{{--                        <h5 class="m-0 font-15">Auto Updates</h5>--}}
{{--                        <p class="text-muted"><small>Keep up to date</small></p>--}}
{{--                    </div> <!-- end col-->--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="custom-control custom-switch mb-2">--}}
{{--                            <input type="checkbox" class="custom-control-input" id="tabswitch3">--}}
{{--                            <label class="custom-control-label" for="tabswitch3"></label>--}}
{{--                        </div>--}}
{{--                    </div> <!-- end col -->--}}
{{--                </div>--}}
{{--                <!-- end row-->--}}

{{--                <div class="row mb-2">--}}
{{--                    <div class="col">--}}
{{--                        <h5 class="m-0 font-15">Online Status</h5>--}}
{{--                        <p class="text-muted"><small>Show your status to all</small></p>--}}
{{--                    </div> <!-- end col-->--}}
{{--                    <div class="col-auto">--}}
{{--                        <div class="custom-control custom-switch mb-2">--}}
{{--                            <input type="checkbox" class="custom-control-input" checked id="tabswitch4">--}}
{{--                            <label class="custom-control-label" for="tabswitch4"></label>--}}
{{--                        </div>--}}
{{--                    </div> <!-- end col -->--}}
{{--                </div>--}}
{{--                <!-- end row-->--}}

{{--                <div class="alert alert-success alert-dismissible fade mt-3 show" role="alert">--}}
{{--                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span>--}}
{{--                    </button>--}}
{{--                    <h5>Unlimited Access</h5>--}}
{{--                    Upgrade to plan to get access to unlimited reports--}}
{{--                    <br/>--}}
{{--                    <a href="javascript: void(0);" class="btn btn-outline-success mt-3 btn-sm">Upgrade<i--}}
{{--                            class="ml-1 mdi mdi-arrow-right"></i></a>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--            <div class="tab-pane show active" id="messages1">--}}
{{--                <div>--}}
{{--                    <div class="inbox-widget">--}}
{{--                        <h5 class="mt-0">Recent</h5>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="online user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a>--}}
{{--                            </p>--}}
{{--                            <p class="inbox-item-text">I've finished it! See you so...</p>--}}
{{--                        </div>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="away user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);"--}}
{{--                                                            class="text-dark">Stillnotdavid</a></p>--}}
{{--                            <p class="inbox-item-text">This theme is awesome!</p>--}}
{{--                        </div>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="online user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a>--}}
{{--                            </p>--}}
{{--                            <p class="inbox-item-text">Nice to meet you</p>--}}
{{--                        </div>--}}

{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="busy user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a>--}}
{{--                            </p>--}}
{{--                            <p class="inbox-item-text">Hey! there I'm available...</p>--}}
{{--                        </div>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-6.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i class="user-status"></i>--}}
{{--                            </div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);"--}}
{{--                                                            class="text-dark">Adhamdannaway</a></p>--}}
{{--                            <p class="inbox-item-text">This theme is awesome!</p>--}}
{{--                        </div>--}}

{{--                        <hr/>--}}
{{--                        <h5>Favorite <span class="float-right badge badge-pill badge-danger">18</span></h5>--}}
{{--                        <hr/>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-7.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="busy user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kennith</a>--}}
{{--                            </p>--}}
{{--                            <p class="inbox-item-text">I've finished it! See you so...</p>--}}
{{--                        </div>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="busy user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);"--}}
{{--                                                            class="text-dark">Stillnotdavid</a></p>--}}
{{--                            <p class="inbox-item-text">This theme is awesome!</p>--}}
{{--                        </div>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-10.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="online user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kimberling</a>--}}
{{--                            </p>--}}
{{--                            <p class="inbox-item-text">Nice to meet you</p>--}}
{{--                        </div>--}}

{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i class="user-status"></i>--}}
{{--                            </div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a>--}}
{{--                            </p>--}}
{{--                            <p class="inbox-item-text">Hey! there I'm available...</p>--}}
{{--                        </div>--}}
{{--                        <div class="inbox-item">--}}
{{--                            <div class="inbox-item-img"><img src="assets/images/users/avatar-9.jpg"--}}
{{--                                                             class="rounded-circle" alt=""> <i--}}
{{--                                    class="away user-status"></i></div>--}}
{{--                            <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Leonareade</a>--}}
{{--                            </p>--}}
{{--                            <p class="inbox-item-text">This theme is awesome!</p>--}}
{{--                        </div>--}}

{{--                        <div class="text-center mt-2">--}}
{{--                            <a href="javascript:void(0);" class="text-muted"><i--}}
{{--                                    class="mdi mdi-spin mdi-loading mr-1"></i> Load more </a>--}}
{{--                        </div>--}}

{{--                    </div> <!-- end inbox-widget -->--}}
{{--                </div> <!-- end .p-3-->--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div> <!-- end slimscroll-menu-->--}}
{{--</div>--}}
{{--<!-- /Right-bar -->--}}

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

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

