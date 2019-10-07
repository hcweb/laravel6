@extends('frontend.layout')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center" style="padding-bottom: 3px;">
                    <nav aria-label="breadcrumb" >
                        <ol class="breadcrumb pl-0 pr-0 pb-0" style="background: none;">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">首页</a></li>
                            @foreach ($breadcrumb as $v)
                                @if ($loop->last)
                                    <li class="breadcrumb-item active" aria-current="page">{{$v->title}}</li>
                                @else
                                    <li class="breadcrumb-item"><a href="{{route('home.content',['mould'=>\Illuminate\Support\Str::studly($v->mould->table_name),'alias'=>$v->alias,'mid'=>$v->mould->id,'id'=>$v->id, 'number'=>config('base_config.page_number'),
                        'order'=>'title_asc'])}}">{{$v->title}}</a></li>
                                @endif
                            @endforeach
                            <div class="ml-3">(共<strong class="text-danger">{{$count}}</strong>条记录)</div>
                        </ol>

                    </nav>
                    <div class="flex-row d-flex">
                        @if (request()->route()->getName() == 'home.search')
                            <select name="number" class="form-control mr-3 app-common-select" style="width: 150px;">
                                <option value="30" {{request('number') == "30" ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number=30&order='.request('order').'&query='.request('query').'&field='.request('field'))}}">30条/页</option>
                                <option value="50" {{request('number') == '50' ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number=50&order='.request('order').'&query='.request('query').'&field='.request('field'))}}">50条/页</option>
                            </select>
                            <select name="order" class="form-control app-common-select" style="width: 150px;">
                                <option value="">---结果排序---</option>
                                <option value="title_asc" {{request('order') == 'title_asc' ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number='.request('number').'&order=title_asc&query='.request('query').'&field='.request('field'))}}">标题升序</option>
                                <option value="title_desc" {{request('order') == 'title_desc' ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number='.request('number').'&order=title_desc&query='.request('query').'&field='.request('field'))}}">标题降序</option>
                                @if (request('mid') === '1')
                                    <option value="push_asc" {{request('order') == 'push_asc' ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number='.request('number').'&order=push_asc&query='.request('query').'&field='.request('field'))}}">发行时间升序</option>
                                    <option value="push_desc" {{request('order') == 'push_desc' ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number='.request('number').'&order=push_desc&query='.request('query').'&field='.request('field'))}}">发行时间降序</option>
                                @endif
                                <option value="create_asc" {{request('order') == 'create_asc' ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number='.request('number').'&order=create_asc&query='.request('query').'&field='.request('field'))}}">创建时间升序</option>
                                <option value="create_desc" {{request('order') == 'create_desc' ? 'selected' : ''}} data-src="{{url('search.html?mid='.request('mid').'&cid='.request('cid').'&number='.request('number').'&order=create_desc&query='.request('query').'&field='.request('field'))}}">创建时间降序</option>
                            </select>
                        @else
                            <select name="number" class="form-control mr-3 app-common-select" style="width: 150px;">
                                <option value="30" {{request('number') == "30" ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>'30','order'=>'title_asc'])}}">30条/页</option>
                                <option value="50" {{request('number') == '50' ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>'50','order'=>'title_asc'])}}">50条/页</option>
                            </select>
                            <select name="order" class="form-control app-common-select" style="width: 150px;">
                                <option value="">---结果排序---</option>
                                <option value="title_asc" {{request('order') == 'title_asc' ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>request('number'),'order'=>'title_asc'])}}">标题升序</option>
                                <option value="title_desc" {{request('order') == 'title_desc' ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>request('number'),'order'=>'title_desc'])}}">标题降序</option>
                                @if (request('mould') === 'Post')
                                    <option value="push_asc" {{request('order') == 'push_asc' ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>request('number'),'order'=>'push_asc'])}}">发行时间升序</option>
                                    <option value="push_desc" {{request('order') == 'push_desc' ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>request('number'),'order'=>'push_desc'])}}">发行时间降序</option>
                                @endif
                                <option value="create_asc" {{request('order') == 'create_asc' ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>request('number'),'order'=>'create_asc'])}}">创建时间升序</option>
                                <option value="create_desc" {{request('order') == 'create_desc' ? 'selected' : ''}} data-src="{{route('home.content',['mould'=>request('mould'),'alias'=>request('alias'),'mid'=>request('mid'),'id'=>request('id'),'number'=>request('number'),'order'=>'create_desc'])}}">创建时间降序</option>
                            </select>
                        @endif

                    </div>
                </div>

                @if (count($data) > 0)
                    <div class="card-columns">
                        @foreach ($data as $v)
                            <div class="card app-card mb-3 animal">
                                <div class="card-body p-2 text-center">
                                    <a target="_blank" href="{{route('home.content.detail',['mould'=>\Illuminate\Support\Str::studly($v->category->mould->table_name),'alias'=>$v->alias,'cid'=>$v->category->id,'id'=>$v->id])}}">
                                        @if (!is_null($v->thumbs))
                                            <?php
                                            $randImg=array_rand(explode(',',$v->thumbs));
                                            ?>
                                            <img src="{{asset(explode(',',$v->thumbs)[$randImg])}}" alt="" class="img-fluid" onerror="this.src='{{asset('frontend/image/no_img.jpg')}}'">
                                        @else
                                            <img src="{{asset('frontend/image/no_img.jpg')}}" alt="" class="img-fluid">

                                        @endif
                                        <p class="card-text text-left" style="margin-top: 5px;">{{\Illuminate\Support\Str::limit($v->title,38)}}</p>
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                    <div id="page" style="display: none;">
                        {{ $data->links() }}
                    </div>
                @else
                    <div class="d-flex" style="min-height: 30rem;justify-content: center;align-items: center;width: 100%;flex-direction: column;">
                        <img src="{{asset('frontend/image/no_data.png')}}" alt="" style="width: 20rem;">
                    </div>
                @endif
            </div>
        </div>
        @include('frontend.common._menu')
    </div>
@endsection
@section('js')
    <script src="{{asset('frontend/js/jquery.mousewheel.min.js')}}"></script>
    <script>
        $(function () {
                @if (count($data) > 0)
            var prePage=$('#page li:first');
            var nextPage=$('#page li:last');

            if (prePage.attr('aria-disabled') != 'true'){
                $('.prePage').attr('href',prePage.find('a').attr('href'));
            }else {
                $('.prePage').attr('href','javascript:;')
            }

            if (nextPage.attr('aria-disabled') != 'true'){
                $('.nextPage').attr('href',nextPage.find('a').attr('href'));
            }else {
                $('.nextPage').attr('href','javascript:;')
            }
            @endif
            $('select[name=number],select[name=order]').change(function () {
                if ($(this).val() != ''){
                    window.location.href=$(this).find("option:selected").data('src');
                }

            });

            $('.app-sub-m').click(function () {
                $(this).toggleClass('active');
                if ($(this).hasClass('active')){
                    $(this).find('i').attr('class','fa fa-angle-double-up');
                    $('.app-sub-nav-box').attr('style','height:auto;');
                }else {
                    $(this).find('i').attr('class','fa fa-angle-double-down');
                    $('.app-sub-nav-box').attr('style','max-height:49px;');
                }
            });
        })
    </script>
@stop
