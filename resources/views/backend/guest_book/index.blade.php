@extends('backend.m_layout')
{{--@section('css')
    <link rel="stylesheet" href="{{asset('backend/style/template.css')}}">
@stop--}}
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row pb-3">
                    <div class="col-lg-8">
                        <form class="form-inline" id="search_form" method="get" action="">
                            <div class="form-group">
                                {!! Form::input('text','key',old('key'),['class'=>'form-control','placeholder'=>'请输入关键词','autocomplete'=>'off']) !!}

                            </div>

                        </form>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="thead-light">
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 30%;">留言者姓名</th>
                            <th style="width: 40%;">内容</th>
                            <th style="width: 25%;">留言时间</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (isset($datas) && count($datas)>0)
                            @foreach ($datas as $v)
                                <tr>
                                    <td>{{$v->id}}</td>
                                    <td>
                                        <div>姓名：{{$v->name}}</div>
                                        <div>电话：{{$v->phone}}</div>
                                    </td>
                                    <td>{{$v->content}}</td>
                                    <td>{{$v->created_at}}</td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="5" class="text-danger text-center">暂无数据</td>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="pull-right">
                    {{$datas->render()}}
                </div>
            </div>
        </div>
    </div>
@stop

