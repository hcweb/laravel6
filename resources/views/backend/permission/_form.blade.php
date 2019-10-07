@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
<div class="row">
    <div class="col-12">
        <div class="card-box">
                @if(isset($permission))
                    {!! Form::model($permission,['url'=>'admin/permission/'.$permission->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                    <input type="hidden" name="permissionId" value="{{$permission->id}}">
                @else
                    {!! Form::open(['route'=>'permission.store','class'=>'form-horizontal']) !!}

                @endif
                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>栏目</label>
                    <div class="col-sm-3">
                        <select name="menu_id" class="form-control select2">
                            <option value="">请选择栏目</option>
                            @foreach($adminSelectMenu as $v)
                                <option value="{{$v->id}}" {{isset($permission) && ($permission->menu_id == $v->id) ? 'selected' : ''}} style="text-align: 20px;">{{str_repeat('|',$v->depth*1)}}{{str_repeat('-',$v->depth*3)}}{{$v->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>名称</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入权限名称','autocomplete'=>'off']) !!}
                    </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">英文如admin_add.</small>
                </div>
                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>别名</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','display_name',old('display_name'),['class'=>'form-control','placeholder'=>'请输入权限别名','autocomplete'=>'off']) !!}
                    </div>
                </div>
                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>路由</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','url',old('url'),['class'=>'form-control','placeholder'=>'请输入权限路由','autocomplete'=>'off']) !!}
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">看护者</label>
                        <div class="col-sm-3">
                            {!! Form::input('text','guard_name',old('guard_name'),['class'=>'form-control','placeholder'=>'请输入权限看护者','autocomplete'=>'off']) !!}
                        </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">不输入则为admin.</small>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">描述</label>
                        <div class="col-sm-6">
                            {!! Form::textarea('description',old('description'),['class'=>'form-control','rows'=>3]) !!}
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
    </script>
@stop
