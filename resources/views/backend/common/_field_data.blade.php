@foreach($fields as $f)
    <div class="row form-group">
        <label class="col-sm-2 text-right col-form-label">
            @if ($f->is_empty == 1)
                <i style="color: red;margin-right: 10px;">*</i>
            @endif
             {{$f->title}}
        </label>
        @switch($f->type)
            @case('text')
            <div class="col-sm-4">
                {!! Form::input('text',$f->name,!empty($f_data[$f->name]) ? old($f->name) : $f->content,['class'=>'form-control','id'=>$f->name.'_'.$f->id,'lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty]) !!}
            </div>
            @if (!empty($f->byte))
                {{$f->byte}}
            @endif
            @break
            @case('multitext')

                <div class="col-sm-6">
                    {!! Form::textarea($f->name,old($f->name), ['lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty,'class' => 'form-control','rows'=>3,'cols'=>60,'id'=>$f->name.'_'.$f->id]) !!}
                </div>

            @break
            @case('datetime')
            <div class="col-sm-4">
                {!! Form::input('text',$f->name,old($f->name),['lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty,'class'=>'form-control','autocomplete'=>'off','id'=>$f->name.'_'.$f->id]) !!}
            </div>
            @break
            @case('htmltext')
            <div class="col-sm-4">
                <!-- 编辑器容器 -->
                <script id="{{$f->name.'_'.$f->id}}" name="{{$f->name}}" value="{{$f->name}}" type="text/plain">
                    @if(isset($f_data)){!! $f_data[$f->name] !!}@endif
                </script>
            </div>
            @break
            @case('img')
            <div class="form-control-inline">
                {!! Form::input('text',$f->name,old($f->name),['lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty,'value'=>'','class'=>'form-control','id'=>$f->name.'_'.$f->id]) !!}
            </div>
            <a class="btn btn-secondary"  style="color: #ffffff;" id="{{$f->name}}_{{$f->id}}_img_btn" data-id="{{$f->name.'_'.$f->id}}"><i class="fa fa-upload"></i>上传图片</a>
            @break
            @case('imgs')
            <div class="layui-input-block">
                <a id="{{$f->name}}_{{$f->id}}_img_btn" class="layui-btn layui-btn-primary" data-id="{{$f->name}}_{{$f->id}}" data-name="{{$f->name}}"><i class="fa fa-plus-circle"></i>上传图片</a>
                @if (!empty($f->tip_content))
                    <button style="margin-left: 10px;" class="layui-btn layui-btn-primary app-tip-info" data-content="{{$f->tip_content}}" onmouseover="layer_tips = layer.tips(this.getAttribute('data-content'), this, {time:100000});" onmouseleave="layer.close(layer_tips);">
                        <i class="fa fa-info-circle"></i>
                    </button>
                @endif
                <br>
                <div class="imgs_box" id="{{$f->name}}_{{$f->id}}_imgb_box">
                    @if (isset($f_data)&&$f_data[$f->name]!=null)
                        @foreach (explode(',',$f_data[$f->name]) as $i)
                            <div class="imgs_item_box">
                                <i class="fa fa-close app-file-delete" data-path="{{$i}}" data-id="{{$f->name}}_{{$f->id}}" data-name="{{$f->name}}"></i>
                                <img src="{{$i}}" alt="">
                                <input type="hidden" value="{{$i}}" name="{{$f->name}}[]">
                                </div>
                        @endforeach
                    @endif
                </div>
                <script>
                    Sortable.create(document.getElementById("{{$f->name}}_{{$f->id}}_imgb_box"));
                </script>
            </div>
            @break
            @case('files')
            <div class="layui-input-block">
                <a id="{{$f->name}}_{{$f->id}}_img_btn" class="layui-btn layui-btn-primary" data-id="{{$f->name}}_{{$f->id}}" data-name="{{$f->name}}"><i class="fa fa-plus-circle"></i>上传附件</a>
                @if (!empty($f->tip_content))
{{--                    <button style="margin-left: 10px;" class="layui-btn layui-btn-primary app-tip-info" data-content="{{$f->tip_content}}" onmouseover="layer_tips = layer.tips(this.getAttribute('data-content'), this, {time:100000});" onmouseleave="layer.close(layer_tips);">--}}
{{--                        <i class="fa fa-info-circle"></i>--}}
{{--                    </button>--}}
                    <small class="form-text text-muted mt-0" style="line-height: 2.2rem">{{$f->tip_content}}.</small>
                @endif
                <br>
                <div class="imgs_box" id="{{$f->name}}_{{$f->id}}_imgb_box">
                    @if (isset($f_data)&&$f_data[$f->name]!=null)
                        @foreach (explode(',',$f_data[$f->name]) as $i)
                            <div class="imgs_item_box" style="border:none;width:auto;height: auto;padding:10px;">
                                <i class="fa fa-close app-file-delete" data-path="{{$i}}" data-id="{{$f->name}}_{{$f->id}}" data-name="{{$f->name}}"></i>
                                <p><a href="javascript:;" data-src="{{$i}}">{{basename(public_path($i))}}</a></p>
                                <input type="hidden" value="{{$i}}" name="{{$f->name}}[]">
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @break
            @case('select')
            <div class="layui-input-inline">
                <select name="{{$f->name}}" lay-verify="{{$f->validate}}" data-is_empty="{{$f->is_empty}}">
                    <option value="">请选择</option>
                    @foreach(explode('|',$f->content) as $m)
                        <option
                            value="{{$loop->index}}" {{isset($f_data)&&$f_data[$f->name] == $loop->index ? 'selected' : ''}}>{{$m}}</option>
                    @endforeach
                </select>
            </div>
            @break;
            @case('switch')
            <div class="layui-input-inline">
                @if (isset($f_data)&&$f_data[$f->name]==1)
                    {!! Form::checkbox($f->name,1,'checked',['lay-skin'=>"switch",'id'=>$f->name.'_'.$f->id,'lay-filter'=>$f->name.'_'.$f->id]) !!}
                    @else
                    {!! Form::checkbox($f->name,0,'',['lay-skin'=>"switch",'id'=>$f->name.'_'.$f->id,'lay-filter'=>$f->name.'_'.$f->id]) !!}
                @endif

            </div>
            @break;
            @case('checkbox')
            <div class="layui-input-block">
                @foreach(explode('|',$f->content) as $m)
                    {!! Form::checkbox($f->name.'[]',$loop->index,isset($f_data)&&str_contains($f_data[$f->name],$loop->index)?'checked':'',['id'=>$f->name.'_'.$f->id.'_'.$loop->index,'title'=>$m]) !!}
                @endforeach
            </div>
            @break;
            @case('radio')
            <div class="layui-input-block">
                @foreach(explode('|',$f->content) as $m)
                    <div class="radio radio-success pull-left">
                        @if(isset($f_data))
                            {!! Form::radio($f->name,$loop->index,$f_data[$f->name] == $loop->index ? 'checked' : '',['id'=>$f->name.'_'.$f->id.'_'.$loop->index,'title'=>$m]) !!}
                        @else
                            {!! Form::radio($f->name,$loop->index,$loop->index == 0 ?  'checked' : '',['id'=>$f->name.'_'.$f->id.'_'.$loop->index,'title'=>$m]) !!}
                        @endif
                    </div>
                @endforeach
            </div>
            @break;
            @case('int')
            <div class="col-sm-4">
                {!! Form::input('text',$f->name,!empty($f_data[$f->name]) ? old($f->name) : $f->content,['lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty,"onkeyup"=>"value=value.replace(/[^0-9]/g,'');","placeholder"=>"只允许纯数字",'class'=>'form-control','id'=>$f->name.'_'.$f->id]) !!}
            </div>
            @if (!empty($f->byte))
                {{$f->byte}}
            @endif
            @break
            @case('float')
            <div class="layui-input-inline">
                {!! Form::input('text',$f->name,!empty($f_data[$f->name]) ? old($f->name) : $f->content,['lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty,"onkeyup"=>"value=value.replace(/[^0-9\.]/g,'')",'placeholder'=>"允许带有小数点的数值",'class'=>'form-control','id'=>$f->name.'_'.$f->id]) !!}
            </div>
            @if (!empty($f->byte))
                {{$f->byte}}
            @endif
            @break
            @case('decimal')
            <div class="layui-input-inline">
                {!! Form::input('text',$f->name,!empty($f_data[$f->name]) ? old($f->name) : $f->content,['lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty,"onkeyup"=>"value=value.replace(/[^0-9\.]/g,'')",'placeholder'=>"允许带有小数点的金额",'class'=>'form-control','id'=>$f->name.'_'.$f->id]) !!}
            </div>
            @if (!empty($f->byte))
                {{$f->byte}}
            @endif
            @break
            @case('color')
            <div class="layui-input-inline" style="width: 120px;">
                {!! Form::input('text',$f->name,old($f->name),['lay-verify'=>$f->validate,'data-is_empty'=>$f->is_empty,'class'=>'form-control','placeholder'=>'请选择颜色','id'=>$f->name.'_'.$f->id]) !!}
            </div>
            <div class="layui-inline" style="left: -11px;margin-bottom: 0">
                <div id="{{$f->name.'_'.$f->id.'color'}}" data-id="{{$f->name.'_'.$f->id}}"></div>
            </div>
            @break
        @endswitch
        @if (!empty($f->tip_content) && $f->type != 'imgs' && $f->type != 'files')
{{--            <button style="margin-left: 10px;" class="layui-btn layui-btn-primary app-tip-info" data-content="{{$f->tip_content}}" onmouseover="layer_tips = layer.tips(this.getAttribute('data-content'), this, {time:100000});" onmouseleave="layer.close(layer_tips);">--}}
{{--                <i class="fa fa-info-circle"></i>--}}
{{--            </button>--}}
            <small class="form-text text-muted mt-0" style="line-height: 2.2rem">{{$f->tip_content}}.</small>
        @endif
    </div>
@endforeach
