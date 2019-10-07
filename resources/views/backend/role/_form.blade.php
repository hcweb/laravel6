
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(isset($role))
                {!! Form::model($role,['url'=>'admin/role/'.$role->id,'class'=>'form-horizontal']) !!}
                {{method_field('PUT')}}
                <input type="hidden" name="roleId" value="{{$role->id}}">
            @else
                {!! Form::open(['route'=>'role.store','class'=>'form-horizontal']) !!}
            @endif

                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>名称</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','name',old('name'),['class'=>'form-control','placeholder'=>'请输入角色名称','autocomplete'=>'off']) !!}
                    </div>
                    <small class="form-text text-muted mt-0" style="line-height: 2.2rem">只能为英文.</small>
                </div>
                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label"><i style="color: red;margin-right: 10px;">*</i>别名</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','display_name',old('display_name'),['class'=>'form-control','placeholder'=>'请输入角色别名','autocomplete'=>'off']) !!}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label">看护者</label>
                    <div class="col-sm-3">
                        {!! Form::input('text','guard_name',old('guard_name'),['class'=>'form-control','placeholder'=>'请输入角色看护者','autocomplete'=>'off']) !!}
                    </div>
                    <small class="form-text text-muted mt-0" style="line-height: 2.2rem">不输入则为admin.</small>
                </div>
                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label">描述</label>
                    <div class="col-sm-6">
                        {!! Form::textarea('description',old('description'),['class'=>'form-control','rows'=>3]) !!}
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-sm-1 text-right col-form-label">权限</label>
                    <div class="col-sm-11">
                        <table class="table table-borderless mb-0">
                            <thead class="thead-light">
                            <tr>
                                <th>导航名称</th>
                                <th>权限分配</th>
                                <th>全选</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($adminSelectMenu as $v)
                                <tr>
                                    <td>
                                    <span style="margin-left: {{$v->depth*20}}px;display: inline-block;">
                                        <i class="fa fa-folder-open"></i>{{$v->title}}
                                    </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                        @if(count($v->permissions) > 0)
                                            @foreach($v->permissions as $c)
                                                @if(isset($role))
                                                    <div class="custom-control custom-checkbox pr-2">
                                                        {!! Form::checkbox('permissions[]',$c->id,$role->permissions,['class'=>'custom-control-input','id'=>'p_check_box'.$c->id]) !!}
                                                        <label class="custom-control-label font-weight-normal" for="p_check_box{{$c->id}}">{{$c->display_name}}</label>
                                                    </div>
                                                @else
                                                        <div class="custom-control custom-checkbox pr-2">
                                                            {!! Form::checkbox('permissions[]',$c->name,null,['class'=>'custom-control-input','id'=>'p_check_box'.$c->id]) !!}
                                                            <label class="custom-control-label font-weight-normal" for="p_check_box{{$c->id}}">{{$c->display_name}}</label>
                                                        </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox pr-2">
                                            <input type="checkbox" class="custom-control-input choseAll" name="" id="p_check_box_all{{$loop->index}}">
                                            <label class="custom-control-label font-weight-normal" for="p_check_box_all{{$loop->index}}">全选</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
    </div>
</div>



@section('script')
    <script>
        $(function () {
            $('.choseAll').change(function () {
                if ($(this).prop("checked")){
                    $(this).parents('td').prev('td').find('input').prop("checked",true);
                }else{
                    $(this).parents('td').prev('td').find('input').prop("checked",false);
                }
            });
        })
    </script>
@stop
