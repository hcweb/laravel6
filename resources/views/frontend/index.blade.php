<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="Keywords" content="{{config('system_config.site_keywords')}}" />
    <meta name="Description" content="{{config('system_config.site_description')}}"/>
	<link rel="icon" sizes="any" mask href="{{config('system_config.site_ico')}}">
    <title>@yield('title',config('system_config.site_title'))</title>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/fontawesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/index.css')}}">
</head>
<body>
<div class="container-fluid" style="justify-content: space-between;display: flex;flex-direction: column;height: 100vh;overflow: hidden;">
    <div class="row top">
        <div class="col-md-6">
            {{config('system_config.site_alias')}}
        </div>
        @if (auth('member')->check())
            <div class="col-md-6 text-right">
                欢迎
                {{auth('member')->user()->name}}
				<a href="{{route('home.member.logout')}}" class="badge badge-info text-white pl-3 pr-3" ><i class="fa fa-sign-out mr-1"></i>退出</a>
            </div>
            @else
            <div class="col-md-6 text-right">
                <a class="mr-2" href="{{route('home.member.login')}}">登录</a>
                <a href="{{route('home.member.register')}}">注册</a>
            </div>
        @endif

    </div>
    <div class="wrap">
    <div class="row text-center">
        <img src="{{config('system_config.site_logo')}}" alt="" class="img-fluid logo">
    </div>
    <div class="d-flex justify-content-center">
    <div class="col-md-6 col-sm-12 col-lg-4">
        <form action="{{route('home.search')}}" method="get">
            <?php
            $types=['books','vods','ppts','pics','tests','softs'];
            ?>
            <div class="app-search-type">
            @foreach($categories as $v)
                    @if ($loop->last)
                        <a href="javascript:;" data-type="{{$types[count($types)-1]}}" data-mid="{{$v->mould_id}}" data-cid="{{$v->id}}" class="mr-2 animal">{{$v->title}}</a>
                    @else
                        <a href="javascript:;" data-type="{{$types[$loop->index]}}" data-mid="{{$v->mould_id}}" data-cid="{{$v->id}}" class="mr-2 animal {{$loop->index === 0 ? 'active' : ''}}">{{$v->title}}</a>
                    @endif
            @endforeach
            </div>
                <input type="hidden" name="mid" value="{{collect($categories)[0]['mould_id']}}">
                <input type="hidden" name="cid" value="{{collect($categories)[0]['id']}}">
                <input type="hidden" name="number" value="{{config('base_config.page_number')}}">
                <input type="hidden" name="order" value="title_asc">
            <div class="app-search-box">
                <input type="text" class="form-control" name="query">
                <button class="btn btn-success"><i class="fa fa-search"></i></button>
            </div>
            <div id="form-type"></div>
        </form>
    </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 5rem;margin-bottom: 5rem;">
        <div class="clearfix"></div>
        <div class="col-md-6 col-sm-12">
            <ul class="list-unstyled row">
                @foreach($categories as $v)
                    <li class="col-md-2 col-sm-2 col-xs-2 text-center">
                        <a href="{{route('home.content',[
                        'mould'=>\Illuminate\Support\Str::studly($v->mould->table_name),
                        'alias'=>$v->alias,
                        'mid'=>$v->mould->id,
                        'id'=>$v->id,
                        'number'=>config('base_config.page_number'),
                        'order'=>'title_asc'
                        ])}}" class="d-flex flex-column animal">
                            <i class="{{$v->icon_class}} mb-2" style="color: {{$v->color}};font-size: 5rem;"></i>
                            {{$v->title}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
    <div>
        <div class="d-flex justify-content-center text-muted">
            <a href="{{route('home.page',['alias'=>'contact_us'])}}">联系我们</a><span>&nbsp;|&nbsp;</span>
            <a href="{{route('home.message')}}">意见建议</a><span>&nbsp;|&nbsp;</span>
            <a href="{{route('home.page',['alias'=>'help'])}}">使用帮助</a><span>&nbsp;|&nbsp;</span>
            <a href="{{route('home.tool')}}">工具软件</a>
            <br>
        </div>
        <p class="text-center text-muted mt-md-1" style="font-size: .7rem;">{{config('system_config.site_copyright')}}</p>
    </div>
</div>
<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/layer/layer.js')}}"></script>
<script>
    $(function () {

            @if(count($errors)>0)
        var html='';
        @foreach($errors->all() as $error)
            html+='<p class="mb-0">{{$error}}</p>';
        layer.msg(html, {icon: 5,offset:'50px'});
        @endforeach
        @endif

        setType('books');
        function setType(type){
            var typeOne='<div class="form-check form-check-inline">\n' +
                '                    <input class="form-check-input" type="radio" name="field" id="type_one_1" value="b_name" checked>\n' +
                '                    <label class="form-check-label" for="type_one_1">书名</label>\n' +
                '                </div>\n' +
                '                <div class="form-check form-check-inline">\n' +
                '                    <input class="form-check-input" type="radio" name="field" id="type_one_2" value="b_auther">\n' +
                '                    <label class="form-check-label" for="type_one_2">作者</label>\n' +
                '                </div>\n' +
                '                <div class="form-check form-check-inline">\n' +
                '                    <input class="form-check-input" type="radio" name="field" id="type_one_3" value="b_cate_number">\n' +
                '                    <label class="form-check-label" for="type_one_3">分类号</label>\n' +
                '                </div>\n' +
                '                <div class="form-check form-check-inline">\n' +
                '                    <input class="form-check-input" type="radio" name="field" id="type_one_4" value="b_isbn">\n' +
                '                    <label class="form-check-label" for="type_one_4">ISBN</label>\n' +
                '                </div>\n' +
                '                <div class="form-check form-check-inline">\n' +
                '                    <input class="form-check-input" type="radio" name="field" id="type_one_5" value="b_summary">\n' +
                '                    <label class="form-check-label" for="type_one_5">摘要</label>\n' +
                '                </div>'+
                '                <div class="form-check form-check-inline">\n' +
                '                    <input class="form-check-input" type="radio" name="field" id="type_one_6" value="all">\n' +
                '                    <label class="form-check-label" for="type_one_6">综合</label>\n' +
                '                </div>';
            var typeTwo='                    <div class="form-check form-check-inline">\n' +
                '                        <input class="form-check-input" type="radio" name="field" id="type_two_1" value="title" checked>\n' +
                '                        <label class="form-check-label" for="type_two_1">标题</label>\n' +
                '                    </div>\n' +
                '                    <div class="form-check form-check-inline">\n' +
                '                        <input class="form-check-input" type="radio" name="field" id="type_two_2" value="author">\n' +
                '                        <label class="form-check-label" for="type_two_2">作者</label>\n' +
                '                    </div>\n' +
                '                    <div class="form-check form-check-inline">\n' +
                '                        <input class="form-check-input" type="radio" name="field" id="type_two_3" value="source">\n' +
                '                        <label class="form-check-label" for="type_two_3">来源</label>\n' +
                '                    </div>\n' +
                '                    <div class="form-check form-check-inline">\n' +
                '                        <input class="form-check-input" type="radio" name="field" id="type_two_4" value="summary">\n' +
                '                        <label class="form-check-label" for="type_two_4">摘要</label>\n' +
                '                    </div>\n' +
                '                    <div class="form-check form-check-inline">\n' +
                '                        <input class="form-check-input" type="radio" name="field" id="type_two_5" value="all">\n' +
                '                        <label class="form-check-label" for="type_two_5">综合</label>\n' +
                '                    </div>';

            if (type == 'books'){
                $('#form-type').empty().html(typeOne);
            }else if (type == 'vods' || type == 'ppts' || type == 'pics' || type == 'tests' || type == 'softs') {
                $('#form-type').empty().html(typeTwo);
            }else {
                $('#form-type').empty().html(typeOne);
            }
        }

        $('.app-search-type a').click(function () {
            $(this).addClass('active').siblings('a').removeClass('active');
            var type=$(this).data('type');
            $('input[name=mid]').val($(this).attr('data-mid'));
            $('input[name=cid]').val($(this).attr('data-cid'));
            setType(type);
        });
    })
</script>
</body>
</html>
