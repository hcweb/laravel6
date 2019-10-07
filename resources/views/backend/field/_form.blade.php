@section('css')
    <link href="{{asset('backend/assets/libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
<div class="row">
    <div class="col-12">
        <div class="card-box">
                @if(isset($field))
                    {!! Form::model($field,['url'=>'admin/field/'.$field->id,'class'=>'form-horizontal']) !!}
                    {{method_field('PUT')}}
                    <input type="hidden" name="fieldId" value="{{$field->id}}">
                @else
                    {!! Form::open(['route'=>'field.store','class'=>'form-horizontal']) !!}
                @endif
                <input type="hidden" name="mould_id" value="{{request('mid')}}">
                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>字段标题</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','title',old('title'),['class'=>'form-control','placeholder'=>'请输入字段标题','autocomplete'=>'off']) !!}
                    </div>
                </div>
                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>字段名称</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'只允许字母、数字和下划线的任意组合','autocomplete'=>'off']) !!}
                    </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">保持唯一性，不可与主表、附加表重.</small>
                </div>

                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>字段类型</label>
                    <div class="col-sm-3">
                        <select name="type"  class="app-field-type form-control select2"  >
                            <option value="text" data-ifoption="0" {{isset($field)&&$field->type==='text' ? 'selected' : ''}}>单行文本</option>
                            <option value="multitext" data-ifoption="0" {{isset($field)&&$field->type==='multitext' ? 'selected' : ''}}>多行文本</option>
                            <option value="htmltext" data-ifoption="0" {{isset($field)&&$field->type==='htmltext' ? 'selected' : ''}}>HTML文本</option>
                            <option value="radio" data-ifoption="1" {{isset($field)&&$field->type==='radio' ? 'selected' : ''}}>单选项</option>
                            <option value="checkbox" data-ifoption="1" {{isset($field)&&$field->type==='checkbox' ? 'selected' : ''}}>多选项</option>
                            <option value="select" data-ifoption="1" {{isset($field)&&$field->type==='select' ? 'selected' : ''}}>下拉框</option>
                            <option value="int" data-ifoption="0" {{isset($field)&&$field->type==='int' ? 'selected' : ''}}>整数类型</option>
                            <option value="float" data-ifoption="0" {{isset($field)&&$field->type==='float' ? 'selected' : ''}}>小数类型</option>
                            <option value="decimal" data-ifoption="0" {{isset($field)&&$field->type==='decimal' ? 'selected' : ''}}>金额类型</option>
                            <option value="img" data-ifoption="0" {{isset($field)&&$field->type==='img' ? 'selected' : ''}}>单张图</option>
                            <option value="imgs" data-ifoption="0" {{isset($field)&&$field->type==='imgs' ? 'selected' : ''}}>多张图</option>
                            <option value="datetime" data-ifoption="0" {{isset($field)&&$field->type==='datetime' ? 'selected' : ''}}>日期和时间</option>
                            <option value="switch" data-ifoption="0" {{isset($field)&&$field->type==='switch' ? 'selected' : ''}}>开关</option>
                            <option value="files" data-ifoption="0" {{isset($field)&&$field->type==='files' ? 'selected' : ''}}>附件</option>
                            <option value="color" data-ifoption="0" {{isset($field)&&$field->type==='color' ? 'selected' : ''}}>取色器</option>
                        </select>
                    </div>
                </div>


                <div class="row form-group" id="dl_dfvalue">
                    <label class="col-sm-1 text-right col-form-label" id="label_dfvalue">默认值</label>
                    <div class="col-sm-6">
                            {!! Form::textarea('content',old('content'),['class'=>'form-control system_content','id'=>'dl_dfvalue_content','placeholder'=>'如果定义字段类型为下拉框、单选项、多选项时，此处填写被选择的项目(用“|”分开，如“男|女”)。','rows'=>3]) !!}
                    </div>
                </div>

                <div class="row form-group" id="dl_dfvalue_unit">
                    <label class="col-sm-1 text-right col-form-label">数值单位</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','byte',old('byte'),['class'=>'form-control','placeholder'=>'比如：元、个、件等等']) !!}
                    </div>
                </div>

                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label">提示文字</label>
                    <div class="col-sm-6">
                        {!! Form::textarea('tip_content',old('tip_content'),['class'=>'form-control system_content','placeholder'=>'提示文字','rows'=>3]) !!}
                    </div>
                </div>

                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label">验证规则</label>
                    <div class="col-sm-6">
                            {!! Form::textarea('validate',old('validate'),['class'=>'form-control system_content','placeholder'=>'请输入验证规则，参考laravel验证规则','rows'=>3]) !!}

                    </div>
                </div>

                    <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label">排序</label>
                    <div class="col-sm-1">
                        {!! Form::input('text','order',isset($field)?old('order'):0,['class'=>'form-control','placeholder'=>'','onkeyup'=>"value=value.replace(/[^\d]/g,'')"]) !!}
                    </div>
                        <small class="form-text text-muted mt-0" style="line-height: 2.2rem">数字越小越靠前.</small>
                </div>

                    <div class="row form-group">
                        <label class="col-sm-1 text-right col-form-label">必填</label>
                        <div class="col-sm-12 col-md-6 d-flex align-items-center">
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('is_empty',1,true,['class'=>'custom-control-input','id'=>'customRadio1']) !!}
                                <label class="custom-control-label font-weight-normal" for="customRadio1">是</label>
                            </div>
                            <div class="custom-control custom-radio pr-2">
                                {!! Form::radio('is_empty',0,false,['class'=>'custom-control-input','id'=>'customRadio2']) !!}
                                <label class="custom-control-label font-weight-normal" for="customRadio2">否</label>
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

            $('.select2').select2();

            $('.select2').on('change',function (e) {
                dtype_change($(this).val());
            });


            function dtype_change(obj) {
                var dtype = obj;
                var ifoption = $('.select2').find('option:selected').data('ifoption');
                if (0 <= $.inArray(dtype, ['datetime','switch','img','imgs','files','color'])) {
                    $('#dl_dfvalue').hide();
                } else {
                    if (1 == ifoption) {
                        $('#label_dfvalue').html('<i style="color: red;margin-right: 10px;">*</i>默认值');
                        $('#dl_dfvalue_content').attr('lay-verify','required');
                    } else {
                        $('#label_dfvalue').html('默认值');
                        $('#dl_dfvalue_content').attr('lay-verify','');
                    }
                    $('#dl_dfvalue').show();
                }
                if (0 <= $.inArray(dtype, ['text','int','float','decimal'])) {
                    $('#dl_dfvalue_unit').show();
                } else {
                    $('#dl_dfvalue_unit').hide();
                }
            }

    </script>
@stop
