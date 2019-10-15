@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(isset($seller))
                {!! Form::model($seller,['url'=>'admin/seller/'.$seller->id,'class'=>'form-horizontal']) !!}
                {{method_field('PUT')}}
            @else
                {!! Form::open(['route'=>'seller.store','class'=>'form-horizontal']) !!}

            @endif

                <div class="form-group row">
                    <label class="col-sm-12 col-md-1 col-form-label text-right">商家类别</label>
                    <div class="col-sm-12 col-md-3">
                        <select name="typeid" class="form-control select2">
                            <option value="">请选择商家类别</option>
                            @foreach($sellerTypeTree as $v)
                                @if(isset($seller) && !is_null($seller->typeid))
                                    <option value="{{$v->id}}" {{$seller->typeid == $v->id ? 'selected' : ''}}>{{str_repeat('|',$v->depth*1)}}{{str_repeat('-',$v->depth*3)}}{{$v->name}}</option>
                                @else
                                    <option style="padding-left: {{$v->depth*3}}px" value="{{$v->id}}" {{isset($seller) && ($seller->typeid == $v->id) ? 'selected' : ''}}>{{str_repeat('|',$v->depth*1)}}{{str_repeat('-',$v->depth*3)}}{{$v->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>商家名称</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入标题','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">Logo</label>
                    <div class="col-sm-11">
                        <div class="row">
                            <div class="col-sm-4">
                                {!! Form::input('text','logo',old('logo'),['class'=>'form-control app-block-img','autocomplete'=>'off']) !!}
                            </div>
                            <div class="app-file-upload-btn">
                                <a class="btn btn-secondary" id="upload-logo" style="color: #ffffff;"><i class="fa fa-upload"></i>上传图片</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">手机号</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','telphone',old('telphone'),['class'=>'form-control','placeholder'=>'请输入手机号','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">邮箱</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','email',old('email'),['class'=>'form-control','placeholder'=>'请输入邮箱','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">描述</label>
                    <div class="col-sm-11">
                        {!! Form::textarea('introduction',old('introduction'),['class'=>'form-control','placeholder'=>'','rows'=>3]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">商家地址</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','address',old('address'),['class'=>'form-control','placeholder'=>'请输入地址','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">营业时间</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','business_hours',old('business_hours'),['class'=>'form-control','placeholder'=>'8点至22点','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">提供服务</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','serve',old('serve'),['class'=>'form-control','placeholder'=>'如：可免费停车','autocomplete'=>'off']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-12 col-md-1 col-form-label text-right">是否有效</label>
                    <div class="col-sm-12 col-md-6 d-flex align-items-center">
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('valid',1,true,['class'=>'custom-control-input','id'=>'customRadio1']) !!}
                            <label class="custom-control-label font-weight-normal" for="customRadio1">显示</label>
                        </div>
                        <div class="custom-control custom-radio pr-2">
                            {!! Form::radio('valid',0,false,['class'=>'custom-control-input','id'=>'customRadio2']) !!}
                            <label class="custom-control-label font-weight-normal" for="customRadio2">隐藏</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-4">
                    <label  class="col-sm-1 col-form-label text-right"></label>
                    <div class="col-sm-11">
                    <button class="btn btn-rounded btn-primary mr-2"><i
                            class="fa fa-save"></i>
                        保存
                    </button>
                    <button type="reset" class="btn btn-rounded btn-warning mr-2"><i
                            class="fa fa-retweet"></i> 重置
                    </button>
                    <a href="javascript:history.go(-1)" class="btn btn-rounded btn-light"><i
                            class="fa fa-undo"></i> 返回上一级</a>
                    </div>
                </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>


@section('script')
    <script src="{{asset('backend/assets/libs/select2/select2.min.js')}}"></script>
    <script>
        $(".select2").select2();
        var upload = layui.upload;
        var uploadInst = upload.render({
            elem: '#upload-logo', //绑定元素
            url: "{{route('file.upload')}}", //上传接口
            accept:'images',
            acceptMime:'image/*',
            exts:"{{config('system_config.site_img_type')}}",
            multiple:false,
            data:{
                "_token": "{{csrf_token()}}",
                'f_type':'img'
            },
            done: function(res){
                //上传完毕回调
                $(".app-block-img").val(res.data.path);
            },
            error: function(index, upload){
                //请求异常回调
                layer.msg("上传失败！", {icon: 5});
            }
        });
    </script>
@stop
