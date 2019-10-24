@extends('backend.layout')
@section('content')
    <!-- start page title -->

    <!-- end page title -->

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#1abc9c"
                           data-bgColor="#d1f2eb" value="58"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h3 class="mb-1"> 268 </h3>
                    <p class="text-muted mb-1">New Customers</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#3bafda"
                           data-bgColor="#d8eff8" value="80"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h3 class="mb-1"> 8715 </h3>
                    <p class="text-muted mb-1">Online Orders</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f672a7"
                           data-bgColor="#fde3ed" value="77"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h3 class="mb-1"> $925.78 </h3>
                    <p class="text-muted mb-1">Revenue</p>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-3 col-md-6">
            <div class="card-box">
                <div class="float-left" dir="ltr">
                    <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#6c757d"
                           data-bgColor="#e2e3e5" value="35"
                           data-skin="tron" data-angleOffset="0" data-readOnly=true
                           data-thickness=".15"/>
                </div>
                <div class="text-right">
                    <h3 class="mb-1"> $78.58 </h3>
                    <p class="text-muted mb-1">Daily Average</p>
                </div>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->

    <div class="row">
          <div class="col-xl-12">
            <div class="card-box">
                <div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                       aria-expanded="false">
                        <i class="mdi mdi-dots-horizontal"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Settings</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Download</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Upload</a>
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                    </div>
                </div>
                <h4 class="header-title mb-3">最新留言信息</h4>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover table-centered m-0">

                        <thead class="thead-light">
                        <tr>
                            <th>Marketplaces</th>
                            <th>Date</th>
                            <th>US Tax Hold</th>
                            <th>Payouts</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Themes Market</h5>
                            </td>

                            <td>
                                Oct 15, 2018
                            </td>

                            <td>
                                $125.23
                            </td>

                            <td>
                                $5848.68
                            </td>

                            <td>
                                <span class="badge badge-light-warning">Upcoming</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i
                                        class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Freelance</h5>
                            </td>

                            <td>
                                Oct 12, 2018
                            </td>

                            <td>
                                $78.03
                            </td>

                            <td>
                                $1247.25
                            </td>

                            <td>
                                <span class="badge badge-light-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i
                                        class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Share Holding</h5>
                            </td>

                            <td>
                                Oct 10, 2018
                            </td>

                            <td>
                                $358.24
                            </td>

                            <td>
                                $815.89
                            </td>

                            <td>
                                <span class="badge badge-light-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i
                                        class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Envato's Affiliates</h5>
                            </td>

                            <td>
                                Oct 03, 2018
                            </td>

                            <td>
                                $18.78
                            </td>

                            <td>
                                $248.75
                            </td>

                            <td>
                                <span class="badge badge-light-danger">Overdue</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i
                                        class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Marketing Revenue</h5>
                            </td>

                            <td>
                                Sep 21, 2018
                            </td>

                            <td>
                                $185.36
                            </td>

                            <td>
                                $978.21
                            </td>

                            <td>
                                <span class="badge badge-light-warning">Upcoming</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i
                                        class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <h5 class="m-0 font-weight-normal">Advertise Revenue</h5>
                            </td>

                            <td>
                                Sep 15, 2018
                            </td>

                            <td>
                                $29.56
                            </td>

                            <td>
                                $358.10
                            </td>

                            <td>
                                <span class="badge badge-light-success">Paid</span>
                            </td>

                            <td>
                                <a href="javascript: void(0);" class="btn btn-xs btn-secondary"><i
                                        class="mdi mdi-pencil"></i></a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!-- end .table-responsive-->
            </div> <!-- end card-box-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
