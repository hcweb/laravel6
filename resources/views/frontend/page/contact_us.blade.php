@extends('frontend.layout')
@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0 pr-0 pb-0" style="background: none;">
            <li class="breadcrumb-item"><a href="{{url('/')}}">首页</a></li>
            <li class="breadcrumb-item active" aria-current="page">联系我们</li>
        </ol>
    </nav>
    <div class="col-12 bg-white mb-md-5 pt-3">
        <img src="{{asset('frontend/image/contant_us.jpg')}}" alt="" class="img-fluid">
        {!! $data->content !!}
    </div>
        </div>
    </div>
@endsection

