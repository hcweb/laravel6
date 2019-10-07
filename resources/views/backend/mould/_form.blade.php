<div class="row">
    <div class="col-12">
        <div class="card-box">
                @if(isset($mould))
                    {!! Form::model($mould,['url'=>'admin/mould/'.$mould->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                    <input type="hidden" name="mouldId" value="{{$mould->id}}">
                @else
                    {!! Form::open(['route'=>'mould.store','class'=>'form-horizontal']) !!}
                @endif
                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>模型名称</label>
                    <div class="col-sm-3">
                        @if (isset($mould) && $mould->is_system == 1)
                           <p style="margin-top: 7px;"> {{$mould->name}}</p>
                            <input type="hidden" name="name" value="{{$mould->name}}">
                            @else
                            {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入模型名称','autocomplete'=>'off']) !!}
                        @endif

                    </div>
                </div>
                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>模型标识</label>
                        <div class="col-sm-3">
                        @if (isset($mould))
                            <p style="margin-top: 7px;"> {{$mould->table_name}}</p>
                            <input type="hidden" name="table_name" value="{{$mould->table_name}}">
                            @else
                            {!! Form::input('text','table_name',old('table_name'),['class'=>'form-control','placeholder'=>'请输入模型表名称','autocomplete'=>'off']) !!}
                        @endif

                    </div>
                    @if (empty($mould))
                            <small class="form-text text-muted mt-0" style="line-height: 2.2rem">以字母开头，长度在2~12之间，只能包含字母、数字和下划线.</small>
                    @endif

                </div>
                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">排序</label>
                        <div class="col-sm-1">
                            {!! Form::input('text','order',isset($mould)?old('order'):0,['class'=>'form-control','placeholder'=>'','onkeyup'=>"value=value.replace(/[^\d]/g,'')"]) !!}
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">描述</label>
                        <div class="col-sm-6">
                                {!! Form::textarea('des',old('des'),['class'=>'form-control','rows'=>3]) !!}
                        </div>
                    </div>

                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">是否启用</label>
                        <div class="col-sm-12 col-md-6 d-flex align-items-center">
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('status',1,true,['class'=>'custom-control-input','id'=>'customRadio1']) !!}
                                <label class="custom-control-label font-weight-normal" for="customRadio1">启用</label>
                            </div>
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('status',0,false,['class'=>'custom-control-input','id'=>'customRadio2']) !!}
                                <label class="custom-control-label font-weight-normal" for="customRadio2">禁用</label>
                            </div>
                        </div>
                    </div>



                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">提示</label>
                        <div class="col-sm-11">
                            <blockquote class="blockquote">
                                <p class="mb-0">与文档的模板相关连，建议由小写字母、数字组成，因为部份Unix系统无法识别中文文件。</p>
                                <p class="mb-0">列表模板是：list_模型标识.blade.php</p>
                                <p class="mb-0">文档模板是：view_模型标识.blade.php</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">标题重复</label>
                        <div class="col-sm-12 col-md-6 d-flex align-items-center">
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('repeat',1,true,['class'=>'custom-control-input','id'=>'rcustomRadio1']) !!}
                                <label class="custom-control-label font-weight-normal" for="rcustomRadio1">允许</label>
                            </div>
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('repeat',0,false,['class'=>'custom-control-input','id'=>'rcustomRadio2']) !!}
                                <label class="custom-control-label font-weight-normal" for="rcustomRadio2">不允许</label>
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
    <script>
        layui.use(['jquery','form'],function () {
            var $ = layui.$;
            var form = layui.form;
        });
    </script>
@stop
