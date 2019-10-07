@extends('backend.layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#link-list" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-inline-block">友情链接列表</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#link-cate" data-toggle="tab" aria-expanded="true" class="nav-link">
                            <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-inline-block">友情链接分类</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="link-list">
                        <div class="row pb-3">
                            <div class="col-lg-8">
                                <form class="form-inline">
                                    <div class="form-group">
                                        <label for="inputPassword2" class="sr-only">Search</label>
                                        <input type="search" class="form-control" id="inputPassword2" placeholder="请输入关键字进行查询...">
                                    </div>
                                    <div class="form-group mx-sm-3">
                                        <label for="status-select" class="mr-2">Sort By</label>
                                        <select class="custom-select" id="status-select">
                                            <option selected="">All</option>
                                            <option value="1">Date</option>
                                            <option value="2">Name</option>
                                            <option value="3">Revenue</option>
                                            <option value="4">Employees</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            @can('link_create')
                            <div class="col-lg-4">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="{{route('link.create')}}" class="btn btn-secondary waves-effect waves-light btn-rounded"
                                    ><i
                                            class="mdi mdi-plus-circle mr-1"></i> 添加列表</a>
                                </div>
                            </div><!-- end col-->
                                @endcan
                        </div>
                      <div class="table-responsive">
                          <table class="table table-borderless mb-0">
                              <thead class="thead-light">
                                  <tr>
                                      <th>ID</th>
                                      <th>名称</th>
                                      <th>所属分类</th>
                                      <th>LOGO</th>
                                      <th>内容</th>
                                      <th>状态</th>
                                      @canany('link_edit','link_destroy')
                                      <th>操作</th>
                                      @endcanany
                                  </tr>
                              </thead>
                              <tbody>
                              @if (count($links) > 0)
                                  @foreach($links as $v)
                                      <tr>
                                          <td>{{$v->id}}</td>
                                          <td>{{$v->title}}</td>
                                          <td>{{$v->link->name}}</td>
                                          <td><img src="{{$v->logo}}" alt="" style="width: 100px;"></td>
                                          <td>
                                              <p>URL:{{$v->url}}</p>
                                              <p>姓名:{{$v->user_name}}</p>
                                              <p>邮箱:{{$v->user_email}}</p>
                                              <p>手机:{{$v->user_phone}}</p>
                                              <p>描述:{{$v->description}}</p>
                                          </td>
                                          <td>
                                            <span
                                                class="badge {{$v->is_show === 1 ? 'badge-light-primary' : 'badge-light-warning'}}">{{$v->is_show === 1 ? '显示' : '隐藏'}}</span>
                                          </td>
                                          <td class="table_tools">
                                              <a href="{{url('admin/link/'.$v->id.'/edit')}}"
                                                 class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 btn-rounded"><i
                                                      class="fa fa-edit"></i> 编辑</a>
                                              <a href="javascript:;"
                                                 onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                                 class="btn btn-outline-danger waves-effect waves-light btn-sm btn-rounded"><i
                                                      class="fa fa-trash"></i> 删除</a>
                                          </td>
                                      </tr>
                                  @endforeach
                              @else
                                  <td colspan="7" class="text-danger text-center">暂无数据</td>
                              @endif
                              </tbody>
                          </table>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="link-cate">
                        <div class="row pb-3">
                            <div class="col-lg-8">

                            </div>
                            <div class="col-lg-4">
                                <div class="text-lg-right mt-3 mt-lg-0">
                                    <a href="javascript:;" id="add-link-cate" data-toggle="modal" data-animation="sidefall" data-target=".bs-example-modal-center" class="btn btn-secondary waves-effect waves-light btn-rounded"
                                    ><i
                                            class="mdi mdi-plus-circle mr-1"></i> 添加分类</a>
                                </div>
                            </div><!-- end col-->
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>分类</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($linkCates) > 0)
                                    @foreach($linkCates as $v)
                                        <tr>
                                            <td>{{$v->id}}</td>
                                            <td>{{$v->name}}</td>
                                            <td>{{$v->created_at}}</td>
                                            <td class="table_tools">
                                                <a href="javascript:;"
                                                   data-id="{{$v->id}}" data-name="{{$v->name}}"
                                                   class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 app-link-cate-edit btn-rounded"><i
                                                        class="fa fa-edit"></i> 编辑</a>
                                                <a href="javascript:;"
                                                   data-id="{{$v->id}}"
                                                   onclick="app.delete('{{url('admin/link/cate/delete')}}','{{$v->id}}')"
                                                   class="btn btn-outline-danger waves-effect waves-light btn-sm app-link-cate-del btn-rounded"><i
                                                        class="fa fa-trash"></i> 删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <td colspan="4" class="text-danger text-center">暂无数据</td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="linkCateBox" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">友情链接分类</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control linkCate" name="link-cate" placeholder="请输入分类名称">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect btn-rounded" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-info waves-effect waves-light btn-rounded saveCate">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop
@section('script')

    <script>
        let cateId=null;
        $(function () {
            $('#linkCateBox').on('hide.bs.modal', function () {
                $('.linkCate').val('');
                cateId=null;
            });
        });

        $('.saveCate').click(function () {
            if ($('.linkCate').val() == ''){
                swal({
                    icon: "error",
                    timer: '2000',
                    button:false,
                    text: '分类名称不能为空！'
                });
            }else{
                sendAjax(cateId,$('.linkCate').val());
            }
        });




        $('.app-link-cate-edit').click(function () {
            $('#linkCateBox').modal('show');
            $('.linkCate').val($(this).data('name'));
            cateId=$(this).data('id');
        });

        function sendAjax(id, name) {
            $.ajax({
                type: "POST",
                url: "{{route('link.cate.save')}}",
                async: true,
                dataType: 'json',
                data: {
                    name: name,
                    id: id,
                    _token: "{{csrf_token()}}",
                },
                success: function (response) {
                    if (response.code == 1) {
                        swal({
                            text: response.msg,
                            icon: "success",
                            timer: '2000',
                            button:false
                        });
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);
                    } else {
                        swal({
                            text: response.msg,
                            icon: "error",
                            timer: '2000',
                            button:false
                        });
                    }
                },
                error: function (response, textStatus, errorThrown) {
                    if (response.responseJSON.errors != undefined) {
                        var errors = '';
                        for (var i = 0; i < response.responseJSON.errors.name.length; i++) {
                            errors += '<p>' + response.responseJSON.errors.name[i] + '</p>'
                        }
                        var errorBox = document.createElement("div");
                        errorBox.innerHTML=errors;
                        swal({
                            icon: "error",
                            timer: '2000',
                            button:false,
                            content: errorBox
                        });
                    } else {
                        swal({
                            text: response.msg,
                            icon: "error",
                            timer: '2000',
                            button:false,
                        });
                    }

                }
            });
        };


    </script>
@stop
