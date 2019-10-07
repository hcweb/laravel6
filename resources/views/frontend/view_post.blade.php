@extends('frontend.layout')
@section('content')
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb pl-0 pr-0 pb-0" style="background: none;">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">首页</a></li>
                    @foreach ($breadcrumb as $v)
                    <li class="breadcrumb-item"><a href="{{route('home.content',['mould'=>\Illuminate\Support\Str::studly($v->mould->table_name),'alias'=>$v->alias,'mid'=>$v->mould->id,'id'=>$v->id,'number'=>config('base_config.page_number'),
                        'order'=>'title_asc'])}}">{{$v->title}}</a></li>
                    @endforeach
                </ol>
            </nav>
            <div class="col-12 bg-white mb-md-5">
                <div class="row pt-3 pb-3">
                    <div class="col-md-5">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="height: 550px;overflow: hidden;">
                            <ol class="carousel-indicators">
                                @foreach (explode(',',$data->thumbs) as $v)
                                    @if ($loop->index === 0)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="active"></li>
                                        @else
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"></li>
                                    @endif

                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach (explode(',',$data->thumbs) as $v)
                                    @if ($loop->index === 0)
                                    <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                        @endif
                                        <img class="d-block w-100" src="{{asset($v)}}" alt="First slide" onerror="this.src='{{asset("frontend/image/no_img.jpg")}}'" style="height: 100%;width: 100%">
                                    </div>
                                @endforeach

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <h3 class="pt-3 pb-3">{{$data->title}}</h3>
                        <p class="text-muted"><span class="text-dark">作者:</span>{{$data->record->b_auther}}</p>
                        <p class="text-muted"><span class="text-dark">出版社:</span>{{$data->record->b_house}}</p>
                        <p class="text-muted"><span class="text-dark">出版日期:</span>{{$data->record->b_push_time}}</p>
                        <p class="text-muted"><span class="text-dark">ISBN:</span>{{$data->record->b_isbn}}</p>
                        <p class="text-muted"><span class="text-dark">主题词:</span>{{$data->record->b_theme_word}}</p>
                        <p class="text-muted"><span class="text-dark">页码:</span>{{$data->record->b_page_number}}</p>
                        <p class="text-muted"><span class="text-dark">中图分类号:</span>{{$data->record->b_cate_number}}</p>
                        <p class="text-muted"><span class="text-dark">价格:</span>{{$data->record->b_price}}</p>
                        <p class="text-muted"><span class="text-dark">摘要:</span>{{$data->record->b_summary}}</p>

                        <div class="d-flex align-items-center text-center">
                            @if (!is_null($data->m_file))
                                <a href="{{route('home.file',['mould'=>\Illuminate\Support\Str::studly($data->category->mould->table_name),'type'=>'look','id'=>$data->id])}}" id="online-see" class="btn btn-info mr-3"><i class="fa fa-eye mr-1"></i>在线预览</a>
                                <a href="{{route('home.file',['mould'=>\Illuminate\Support\Str::studly($data->category->mould->table_name),'type'=>'download','id'=>$data->id])}}" class="btn btn-success"><i class="fa fa-download mr-1"></i>文件下载</a>
                            @else
                                <a href="javascript:;" id="online-see" class="btn btn-info mr-3"><i class="fa fa-eye mr-1"></i>在线预览</a>
                                <a href="#" class="btn btn-success"><i class="fa fa-download mr-1"></i>文件下载</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
