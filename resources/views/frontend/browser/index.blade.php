@extends('frontend.layout')
@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0 pr-0 pb-0" style="background: none;">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">首页</a></li>
                    <li class="breadcrumb-item active" aria-current="page">浏览历史</li>
                </ol>
            </nav>
            <div class="col-12 bg-white mb-md-5 pt-3">
                <ul class="list-unstyled">
                    @foreach ($data as $v)
                    <li class="media mb-3">
                        <a href="{{route('home.content.detail',['mould'=>\Illuminate\Support\Str::studly($v->category->mould->table_name),'alias'=>$v->alias,'cid'=>$v->category->id,'id'=>$v->id])}}">
                        @if (!is_null($v->thumbs))
                            <?php
                            $randImg=array_rand(explode(',',$v->thumbs));
                            ?>
                            <img style="width: 120px;height: 120px;" src="{{asset(explode(',',$v->thumbs)[$randImg])}}" alt="" class="img-fluid mr-3 rounded-circle" onerror="this.src='{{asset('frontend/image/no_img.jpg')}}'">
                        @else
                            <img style="width: 120px;height: 120px;" src="{{asset('frontend/image/no_img.jpg')}}" alt="" class="img-fluid mr-3 rounded-circle">

                        @endif
                        </a>
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">{{$v->title}}</h5>
                            <p class="mb-0">{{$v->created_at}}</p>
                            <p class="text-black-50">{{$v->summary}}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
