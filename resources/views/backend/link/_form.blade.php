@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(isset($link))
                {!! Form::model($link,['url'=>'admin/link/'.$link->id,'class'=>'']) !!}
                {{method_field('PUT')}}
            @else
                {!! Form::open(['route'=>'link.store','class'=>'form-horizontal']) !!}
            @endif
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>分类</label>
                <div class="col-sm-12 col-md-3">
                    <select name="link_id" class="form-control select2">
                        <option value="">请选择分类</option>
                        @foreach($linkCates as $v)
                            <option
                                value="{{$v->id}}" {{isset($link) && ($link->link_id == $v->id) ? 'selected' : ''}}>{{str_repeat('-',$v->depth*3)}}{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>名称</label>
                <div class="col-sm-3">
                    {!! Form::input('text','title',old('title'),['class'=>'form-control','placeholder'=>'请输入名称','autocomplete'=>'off']) !!}
                </div>
            </div>
            <div class="form-group row">
                <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>地址Url</label>
                <div class="col-sm-3">
                    {!! Form::input('text','url',old('url'),['class'=>'form-control','placeholder'=>'请输入友情链接地址','autocomplete'=>'off']) !!}
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
                        <a class="btn btn-secondary" id="upload-avatar" style="color: #ffffff;"><i class="fa fa-upload"></i>上传图片</a>
                    </div>
                </div>
                </div>
            </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">姓名</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','user_name',old('user_name'),['class'=>'form-control','placeholder'=>'请输入姓名','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">手机号</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','user_phone',old('user_phone'),['class'=>'form-control','placeholder'=>'请输入手机号','autocomplete'=>'off']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">邮箱</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','user_email',old('user_email'),['class'=>'form-control','placeholder'=>'请输入邮箱','autocomplete'=>'off']) !!}
                    </div>
                </div>
            <div class="form-group row">
                <label  class="col-sm-1 col-form-label text-right">排序</label>
                <div class="col-sm-1">
                    {!! Form::input('text','order',isset($link)?old('order'):0,['class'=>'form-control','placeholder'=>'']) !!}
                </div>
            </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">描述</label>
                    <div class="col-sm-11">
                        {!! Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>'','rows'=>3]) !!}
                    </div>
                </div>
            <div class="form-group row">
                <label  class="col-sm-12 col-md-1 col-form-label text-right">是否显示</label>
                <div class="col-sm-12 col-md-6 d-flex align-items-center">
                    <div class="custom-control custom-radio pr-2">
                        {!! Form::radio('is_show',1,true,['class'=>'custom-control-input','id'=>'customRadio1']) !!}
                        <label class="custom-control-label font-weight-normal" for="customRadio1">显示</label>
                    </div>
                    <div class="custom-control custom-radio pr-2">
                        {!! Form::radio('is_show',0,false,['class'=>'custom-control-input','id'=>'customRadio2']) !!}
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
            elem: '#upload-avatar', //绑定元素
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
