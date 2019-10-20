
{{--@if(request()->route()->getName() != 'backend.home')--}}
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="page-title-box">--}}
{{--                <div class="page-title-right">--}}
{{--                    <ol class="breadcrumb m-0">--}}
{{--                        <li class="breadcrumb-item"><a href="{{route('backend.home')}}"><i class="fa fa-home m-r-5"></i>控制面板</a></li>--}}
{{--                        @foreach($breadcrumbs as $v)--}}
{{--                            @if(end($breadcrumbs)['title'] != $v['title'])--}}
{{--                                <li class="breadcrumb-item"><a--}}
{{--                                        href="{{!empty($v['route']) ? route($v['route']) : ''}}">{{$v['title']}}</a>--}}
{{--                                </li>--}}
{{--                            @else--}}
{{--                                <li class="breadcrumb-item active">{{$v['title']}}</li>--}}
{{--                            @endif--}}
{{--                        @endforeach--}}
{{--                    </ol>--}}
{{--                </div>--}}
{{--                <h4 class="page-title">{{end($breadcrumbs)['title']}}</h4>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    @else--}}
{{--    <div class="row" style="height: 30px;"></div>--}}
{{--@endif--}}
<div class="row" style="height: 30px;"></div>
