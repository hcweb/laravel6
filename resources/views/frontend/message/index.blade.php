@extends('frontend.layout')
@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0 pr-0 pb-0" style="background: none;">
            <li class="breadcrumb-item"><a href="{{url('/')}}">首页</a></li>
            <li class="breadcrumb-item active" aria-current="page">意见建议</li>
        </ol>
    </nav>
    <div class="col-12 bg-white mb-md-5 pt-3 pb-3" style="background: #FFFFFF url('{{asset('frontend/image/message_bg.jpg')}}') no-repeat center right;background-size: cover">
        <div class="col-5">
            <form method="post" action="{{route('home.message.form')}}">
                @csrf
                <div class="form-group">
                    <label for="inputName">姓名</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="{{old('name')}}" placeholder="请输入姓名">
                </div>
                <div class="form-group">
                    <label for="inputEmail">邮箱</label>
                    <input type="email" class="form-control" id="inputEmail" name="email" value="{{old('email')}}" placeholder="请输入邮箱">
                </div>
                <div class="form-group">
                    <label for="inputPhone">手机号</label>
                    <input type="text" class="form-control" id="inputPhone" name="phone" value="{{old('phone')}}" placeholder="请输入手机号">
                </div>
                <div class="form-group">
                    <label for="inputContent">意见建议</label>
                    <textarea class="form-control" rows="5" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-custom"><i class="fa fa-send mr-3"></i>提交意见建议</button>
            </form>
        </div>
    </div>
        </div>
    </div>
@endsection
