@extends('backend.layout')
@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                {!! Form::open(['route'=>'system.update.all']) !!}

                <ul class="nav nav-tabs nav-bordered">
                    <li class="nav-item">
                        <a href="#base-config" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            <span class="d-inline-block d-sm-none"><i class="fas fa-home"></i></span>
                            <span class="d-none d-sm-inline-block">基本配置</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#file-config" data-toggle="tab" aria-expanded="true" class="nav-link">
                            <span class="d-inline-block d-sm-none"><i class="far fa-user"></i></span>
                            <span class="d-none d-sm-inline-block">文件配置</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#email-config" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <span class="d-inline-block d-sm-none"><i class="far fa-envelope"></i></span>
                            <span class="d-none d-sm-inline-block">邮件配置</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#other-config" data-toggle="tab" aria-expanded="false" class="nav-link">
                            <span class="d-inline-block d-sm-none"><i class="fas fa-cog"></i></span>
                            <span class="d-none d-sm-inline-block">其他配置</span>
                        </a>
                    </li>
                </ul>
                <div class="pt-3">
                    <a href="{{route('system.create')}}" class="btn btn-info waves-effect waves-light btn-rounded mr-2"><i class="mdi mdi-plus-circle mr-1"></i> 添加配置</a>
                    <button class="btn btn-warning waves-effect waves-light btn-rounded"><i class="mdi mdi-content-save mr-1"></i> 保存全部配置</button>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="base-config">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>调用别名</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($systems) > 0)
                                    @foreach($systems as $v)
                                        @if($v->tabType == 'base')
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td>{{$v->title}}</td>
                                                <td>{{$v->name}}</td>
                                                <td>
                                                    @switch($v->type)
                                                        @case('input')
                                                        {!! Form::text('base_content[]',$v->content,['class'=>'form-control app-system-form','data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('textarea')
                                                        {!! Form::textarea('base_content[]',$v->content,['class'=>'form-control app-system-form','rows'=>2,'data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('select')
                                                        <div class="col-3 pl-0 pr-0">
                                                            <select class="form-control select2" data-id="{{$v->id}}"
                                                                    name="base_content[]">
                                                                @if (!is_null($v->value))
                                                                    @foreach(explode('|',$v->value) as $s)
                                                                        <option
                                                                            value="{{$s}}" {{$s == $v->content ? 'selected' : ''}}>{{$s}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        @break
                                                        @case('image')
                                                        <div class="app-system-img-box app-system-img-box{{$v->id}}"
                                                             data-id="{{$v->id}}">
                                                            {!! Form::hidden('base_content[]',$v->content,['class'=>'system_img_input_'.$v->id,'data-id'=>$v->id]) !!}
                                                            <div class="app-system-img">
                                                                <img src="{{$v->content}}" alt="" style="max-width: 150px;">
                                                                <i class="ti-close app-close-img"
                                                                   data-id="{{$v->id}}" data-path="{{$v->content}}"></i>
                                                            </div>
                                                            <div class="app-file-upload-btn">
                                                            <a
                                                                href="javascript:;"
                                                                class="btn btn-secondary {{empty($v->content) ? '' : 'btn-hide'}}"

                                                                id="app-system-upload-{{$v->id}}"><i
                                                                    class="fa fa-upload"></i>上传图片
                                                            </a>
                                                            </div>
                                                        </div>
                                                        @break
                                                        @case('radio')
                                                        <div class="d-flex align-items-center">
                                                            @if (!is_null($v->value))
                                                                @foreach(explode('|',$v->value) as $s)
                                                                    <div class="custom-control custom-radio pr-2">
                                                                        {!! Form::radio('base_content[]',$s,$s==$v->content ?'check':'',['class'=>'app-site-state custom-control-input','title'=>$s,'id'=>'demo-form-inline-'.$loop->index.$v->id,'data-id'=>$v->id]) !!}
                                                                        <label class="custom-control-label font-weight-normal" for="demo-form-inline-{{$loop->index.$v->id}}">{{$s}}</label>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        @break
                                                        @default
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{url('admin/system/'.$v->id.'/edit')}}"
                                                       class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 btn-rounded"
                                                    ><i class="fa fa-edit"></i> 编辑</a>
                                                    <a href="javascript:;"
                                                       onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                                       class="btn btn-outline-danger waves-effect waves-light btn-sm app-link-cate-del btn-rounded"
                                                       data-id="{{$v->id}}"><i class="fa fa-trash"></i> 删除</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <td colspan="5"
                                        style="line-height: 26px !important;padding: 15px;text-align: center;color: #999">
                                        无数据
                                    </td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="file-config">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>调用别名</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($systems) > 0)
                                    @foreach($systems as $v)
                                        @if($v->tabType == 'file')
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td>{{$v->title}}</td>
                                                <td>{{$v->name}}</td>
                                                <td>
                                                    @switch($v->type)
                                                        @case('input')
                                                        {!! Form::text('file_content[]',$v->content,['class'=>'form-control app-system-form','data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('textarea')
                                                        {!! Form::textarea('file_content[]',$v->content,['class'=>'form-control app-system-form','rows'=>2,'data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('select')
                                                        <div class="col-3 pl-0 pr-0">
                                                            <select class="form-control select2" data-id="{{$v->id}}"
                                                                    name="file_content[]">
                                                                @if (!is_null($v->value))
                                                                    @foreach(explode('|',$v->value) as $s)
                                                                        <option
                                                                            value="{{$s}}" {{$s == $v->content ? 'selected' : ''}}>{{$s}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        @break
                                                        @case('image')
                                                        <div class="app-system-img-box app-system-img-box{{$v->id}}"
                                                             data-id="{{$v->id}}">
                                                            {!! Form::hidden('file_content[]',$v->content,['class'=>'system_img_input_'.$v->id,'data-id'=>$v->id]) !!}
                                                            <div class="app-system-img">
                                                                <img src="{{$v->content}}" alt="">
                                                                <i class="ti-close app-close-img"
                                                                   data-id="{{$v->id}}" data-path="{{$v->content}}"></i>
                                                            </div>
                                                            <div class="app-file-upload-btn">
                                                            <a
                                                                href="javascript:;"
                                                                class="btn btn-secondary {{empty($v->content) ? '' : 'btn-hide'}}"
                                                                id="app-system-upload-{{$v->id}}"><i
                                                                    class="fa fa-upload"></i>上传图片
                                                            </a>
                                                            </div>
                                                        </div>
                                                        @break
                                                        @case('radio')
                                                        <div class="d-flex align-items-center">
                                                            @if (!is_null($v->value))
                                                                @foreach(explode('|',$v->value) as $s)
                                                                    <div class="custom-control custom-radio pr-2">
                                                                        {!! Form::radio('file_content[]',$s,$s==$v->content ?'check':'',['class'=>'app-site-state custom-control-input','title'=>$s,'id'=>'demo-form-inline-'.$loop->index.$v->id,'data-id'=>$v->id]) !!}
                                                                        <label class="custom-control-label font-weight-normal" for="demo-form-inline-{{$loop->index.$v->id}}">{{$s}}</label>
                                                                    </div>

                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        @break
                                                        @default
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{url('admin/system/'.$v->id.'/edit')}}"
                                                       class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 btn-rounded"
                                                    ><i class="fa fa-edit"></i> 编辑</a>
                                                    <a href="javascript:;"
                                                       onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                                       class="btn btn-outline-danger waves-effect waves-light btn-sm app-link-cate-del btn-rounded"
                                                       data-id="{{$v->id}}"><i class="fa fa-trash"></i> 删除</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <td colspan="5"
                                        style="line-height: 26px !important;padding: 15px;text-align: center;color: #999">
                                        无数据
                                    </td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="email-config">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>调用别名</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($systems) > 0)
                                    @foreach($systems as $v)
                                        @if($v->tabType == 'email')
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td>{{$v->title}}</td>
                                                <td>{{$v->name}}</td>
                                                <td>
                                                    @switch($v->type)
                                                        @case('input')
                                                        {!! Form::text('email_content[]',$v->content,['class'=>'form-control app-system-form','data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('textarea')
                                                        {!! Form::textarea('email_content[]',$v->content,['class'=>'form-control app-system-form','rows'=>2,'data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('select')
                                                        <div class="col-3 pl-0 pr-0">
                                                            <select class="form-control select2" data-id="{{$v->id}}"
                                                                    name="email_content[]">
                                                                @if (!is_null($v->value))
                                                                    @foreach(explode('|',$v->value) as $s)
                                                                        <option
                                                                            value="{{$s}}" {{$s == $v->content ? 'selected' : ''}}>{{$s}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        @break
                                                        @case('image')
                                                        <div class="app-system-img-box app-system-img-box{{$v->id}}"
                                                             data-id="{{$v->id}}">
                                                            {!! Form::hidden('email_content[]',$v->content,['class'=>'system_img_input_'.$v->id,'data-id'=>$v->id]) !!}
                                                            <div class="app-system-img">
                                                                <img src="{{$v->content}}" alt="">
                                                                <i class="ti-close app-close-img"
                                                                   data-id="{{$v->id}}" data-path="{{$v->content}}"></i>
                                                            </div>
                                                            <div class="app-file-upload-btn">
                                                            <a
                                                                href="javascript:;"
                                                                class="btn btn-secondary {{empty($v->content) ? '' : 'btn-hide'}}"
                                                                id="app-system-upload-{{$v->id}}"><i
                                                                    class="fa fa-upload"></i>上传图片
                                                            </a>
                                                            </div>
                                                        </div>
                                                        @break
                                                        @case('radio')
                                                        <div class="d-flex align-items-center">
                                                        @if (!is_null($v->value))
                                                            @foreach(explode('|',$v->value) as $s)
                                                                <div class="custom-control custom-radio pr-2">
                                                                    {!! Form::radio('email_content[]',$s,$s==$v->content ?'check':'',['class'=>'app-site-state custom-control-input','title'=>$s,'id'=>'demo-form-inline-'.$loop->index.$v->id,'data-id'=>$v->id]) !!}
                                                                    <label class="custom-control-label font-weight-normal" for="demo-form-inline-{{$loop->index.$v->id}}">{{$s}}</label>
                                                                </div>

                                                            @endforeach
                                                        @endif
                                                        </div>
                                                        @break
                                                        @default
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{route('system.edit',$v->id)}}"
                                                       class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 btn-rounded"
                                                    ><i class="fa fa-edit"></i> 编辑</a>
                                                    <a href="javascript:;"
                                                       onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                                       class="btn btn-outline-danger waves-effect waves-light btn-sm app-link-cate-del btn-rounded"
                                                       data-id="{{$v->id}}"><i class="fa fa-trash"></i> 删除</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <td colspan="5"
                                        style="line-height: 26px !important;padding: 15px;text-align: center;color: #999">
                                        无数据
                                    </td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="other-config">
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>调用别名</th>
                                    <th>内容</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($systems) > 0)
                                    @foreach($systems as $v)
                                        @if($v->tabType == 'other')
                                            <tr>
                                                <td>{{$v->id}}</td>
                                                <td>{{$v->title}}</td>
                                                <td>{{$v->name}}</td>
                                                <td>
                                                    @switch($v->type)
                                                        @case('input')
                                                        {!! Form::text('other_content[]',$v->content,['class'=>'form-control app-system-form','data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('textarea')
                                                        {!! Form::textarea('other_content[]',$v->content,['class'=>'form-control app-system-form','rows'=>2,'data-id'=>$v->id]) !!}
                                                        @break
                                                        @case('select')
                                                        <div class="col-3 pl-0 pr-0">
                                                            <select class="form-control select2" data-id="{{$v->id}}"
                                                                    name="other_content[]">
                                                                @if (!is_null($v->value))
                                                                    @foreach(explode('|',$v->value) as $s)
                                                                        <option
                                                                            value="{{$s}}" {{$s == $v->content ? 'selected' : ''}}>{{$s}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        @break
                                                        @case('image')
                                                        <div class="app-system-img-box app-system-img-box{{$v->id}}"
                                                             data-id="{{$v->id}}">
                                                            {!! Form::hidden('other_content[]',$v->content,['class'=>'system_img_input_'.$v->id,'data-id'=>$v->id]) !!}
                                                            <div class="app-system-img">
                                                                <img src="{{$v->content}}" alt="">
                                                                <i data-path="{{$v->content}}" class="ti-close app-close-img"
                                                                   data-id="{{$v->id}}"></i>
                                                            </div>
                                                            <div class="app-file-upload-btn">
                                                            <a
                                                                href="javascript:;"
                                                                class="btn btn-secondary {{empty($v->content) ? '' : 'btn-hide'}}"
                                                                id="app-system-upload-{{$v->id}}"><i
                                                                    class="fa fa-upload"></i>上传图片
                                                            </a>
                                                            </div>
                                                        </div>
                                                        @break
                                                        @case('radio')
                                                        <div class="d-flex align-items-center">
                                                            @if (!is_null($v->value))
                                                                @foreach(explode('|',$v->value) as $s)
                                                                    <div class="custom-control custom-radio pr-2">
                                                                        {!! Form::radio('other_content[]',$s,$s==$v->content ?'check':'',['class'=>'app-site-state custom-control-input','title'=>$s,'id'=>'demo-form-inline-'.$loop->index.$v->id,'data-id'=>$v->id]) !!}
                                                                        <label class="custom-control-label font-weight-normal" for="demo-form-inline-{{$loop->index.$v->id}}">{{$s}}</label>
                                                                    </div>

                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        @break
                                                        @default
                                                        @break
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <a href="{{route('system.edit',$v->id)}}"
                                                       class="btn btn-outline-primary waves-effect waves-light btn-sm mr-1 btn-rounded"
                                                    ><i class="fa fa-edit"></i> 编辑</a>
                                                    <a href="javascript:;"
                                                       onclick="app.delete('{{url()->current()}}','{{$v->id}}')"
                                                       class="btn btn-outline-danger waves-effect waves-light btn-sm app-link-cate-del btn-rounded"
                                                       data-id="{{$v->id}}"><i class="fa fa-trash"></i> 删除</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <td colspan="5"
                                        style="line-height: 26px !important;padding: 15px;text-align: center;color: #999">
                                        无数据
                                    </td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
@section('script')
    <script src="{{asset('backend/assets/libs/select2/select2.min.js')}}"></script>
    <script>
            var upload = layui.upload;
            $(".select2").select2(
                {
                    minimumResultsForSearch: -1
                }
            );

            $('.app-system-img-box').each(function (index, item) {
                var img = $(this).find('img');
                var close = $(this).find('i.app-close-img');
                if (img.attr('src') != '') {
                    close.show();
                    img.show();
                } else {
                    img.hide();
                    close.hide();
                }

                var id = $(this).data('id');
                upload.render({
                    elem: '#app-system-upload-' + id,
                    url: "{{route('file.upload')}}", //上传接口
                    accept: 'images',
                    acceptMime: 'image/*',
                     exts:"{{config('system_config.site_img_type')}}",
                    multiple: false,
                    data: {
                        "_token": "{{csrf_token()}}",
						"f_type":'img'
                    },
                    done: function (res, index, upload) { //上传后的回调

                        layer.msg(res.msg, {icon: 6});

                        $('#app-system-upload-' + id).hide();
                        $('.app-system-img-box' + id).find('input[type=hidden]').attr('value', res.data.path);
                        $('.app-system-img-box' + id).find('img').show().attr('src', res.data.path);
                        $('.app-system-img-box' + id).find('div.app-system-img').show();
                        $('.app-system-img-box' + id).find('i.app-close-img').show();
                    }
                })

            });

            $('.app-close-img').click(function () {
                var path=$(this).data('path');
                $(this).hide();
                $(this).prev('img').attr('src', '').hide();
                $(this).parent().next('div').find('a').removeClass('btn-hide').show();
                $('.system_img_input_' + $(this).data('id')).attr('value', '');

                //删除本地文件
                $.post("{{route('file.remove')}}",{
                    'path':path,
                    '_token':"{{csrf_token()}}"
                },function (response) {
                    if (response.success == true){

                    }
                });
            });
    </script>
@stop
