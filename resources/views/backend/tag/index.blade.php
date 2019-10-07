@extends('backend.layout')
@section('css')

@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
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
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <a href="javascript:;" id="add-link-cate" data-toggle="modal" data-animation="sidefall" data-target=".bs-example-modal-center" class="btn btn-secondary waves-effect waves-light btn-rounded"
                            ><i
                                    class="mdi mdi-plus-circle mr-1"></i> 添加标签</a>
                        </div>
                    </div><!-- end col-->
                </div>
                <table class="table table-borderless mb-0">
                    <thead class="thead-light">
                    <tr>
                        <th class="font-weight-medium">ID</th>
                        <th class="font-weight-medium">名称</th>
                        <th class="font-weight-medium">创建时间</th>
                        <th class="font-weight-medium">操作</th>
                    </tr>
                    </thead>

                    <tbody class="font-14">
                    @if($tags->count())
                        @foreach($tags as $v)
                            <tr>
                                <td><b>{{$v->id}}</b></td>
                                <td>{{$v->name}}</td>
                                <td>{{$v->created_at}}</td>
                                <td class="table_tools">
                                    <a href="javascript:;"
                                       data-id="{{$v->id}}" data-name="{{$v->name}}"
                                       class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 app-link-cate-edit btn-rounded"><i
                                            class="fa fa-edit"></i> 编辑</a>
                                    <a href="javascript:;"
                                       onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                       class="btn btn-outline-danger waves-effect waves-light btn-sm btn-rounded"><i
                                            class="fa fa-trash"></i> 删除</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
    <div id="linkCateBox" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myCenterModalLabel">标签管理</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control linkCate" name="link-cate" placeholder="请输入标签名称">
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
                    text: '标签名称不能为空！'
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
            var url = null;
            var method = null;
            if (id != null) {
                url = "{{url('admin/tag')}}"+"/"+id;
                method = 'PUT';
            } else {
                url = "{{route('tag.store')}}";
                method = 'POST';
            }
            $.ajax({
                type: "POST",
                url: url,
                async: true,
                dataType: 'json',
                data: {
                    name: name,
                    id: id,
                    _method: method,
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

