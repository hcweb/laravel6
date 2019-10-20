@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(isset($sellerType))
                {!! Form::model($sellerType,['url'=>'admin/sellertype/'.$sellerType->id,'class'=>'form-horizontal']) !!}
                {{method_field('PUT')}}
                <input type="hidden" name="sellerTypeId" value="{{$sellerType->id}}">
            @else
                {!! Form::open(['route'=>'sellertype.store','class'=>'form-horizontal']) !!}
            @endif
                <div class="form-group row">
                    <label class="col-sm-12 col-md-1 col-form-label text-right">父类</label>
                    <div class="col-sm-12 col-md-3">
                        <select name="parent_id" class="form-control select2">
                            <option value="">请选择父类</option>
                            @foreach($sellerTypeTree as $v)
                                @if(!is_null(request()->get('id')))
                                    <option value="{{$v->id}}" {{request()->get('id') == $v->id ? 'selected' : ''}}>{{str_repeat('|',$v->depth*1)}}{{str_repeat('-',$v->depth*3)}}{{$v->name}}</option>
                                @else
                                    <option style="padding-left: {{$v->depth*3}}px" value="{{$v->id}}" {{isset($sellerType) && ($sellerType->parent_id == $v->id) ? 'selected' : ''}}>{{str_repeat('|',$v->depth*1)}}{{str_repeat('-',$v->depth*3)}}{{$v->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right"><i style="color: red;margin-right: 10px;">*</i>名称</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入名称','autocomplete'=>'off']) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">图标</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','icon',old('icon'),['class'=>'form-control','placeholder'=>'请输入字体图标','autocomplete'=>'off']) !!}
                    </div>
                    <small class="form-text text-muted mt-0" style="line-height: 2.2rem">如fa fa-home.</small>
                </div>
                <div class="form-group row">
                    <label  class="col-sm-1 col-form-label text-right">排序</label>
                    <div class="col-sm-1">
                        {!! Form::input('text','order_num',isset($sellerType)?old('order_num'):0,['class'=>'form-control','placeholder'=>'']) !!}
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
    </script>
@stop
