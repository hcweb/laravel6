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
    <link rel="stylesheet" href="{{asset('frontend/iconfont/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('static/layer/theme/default/layer.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/app.css')}}">
    <style>
        .app-search-box{position: relative;padding-right: 60px;padding-top: .6rem;padding-bottom: .6rem;}
        .app-search-box input{height: 2rem;}
        .app-search-box button{position: absolute;right:0;top: .6rem;width: 60px;background: #05c591;border: 1px solid #05c591;border-top-left-radius: 0;border-bottom-left-radius: 0;height: 2rem;line-height: 1rem;}
        .app-search-box button:hover{background: #05c591;}
        .app-search-box input{border: 1px solid #05c591;border-left: none;border-radius: 0;}
		 .app-search-box select{border: 1px solid #05c591;border-top-right-radius: 0;border-bottom-right-radius: 0;height: 2rem;width: 120px;line-height: 1rem;font-size: .8rem;}
        .app-search-type a{color: #05c591;}
        .app-search-type a.active{color: #666;}

    </style>
</head>
<body style="background: #f1f1f1;">
<div class="fixed-top">
<nav class="navbar navbar-light bg-light" id="nav">
    <div class="d-flex align-items-center">
        <a class="navbar-brand" href="{{url('/')}}">
            <img src="{{config('system_config.site_logo')}}" alt="" class="img-fluid logo mt-1 mb-1" style="width: 150px">
        </a>
        <div>
			@if(request()->route()->getName() == 'home.content' || request()->route()->getName() == 'home.search')
                <form action="{{route('home.search')}}" method="get">
        <div class="app-search-box d-flex">
            <input type="hidden" name="mid" value="{{request('mid')}}">
            <input type="hidden" name="cid" value="{{request('cid') ?? request('id')}}">
            <input type="hidden" name="number" value="{{request('number')}}">
            <input type="hidden" name="order" value="{{request('order')}}">

			<select class="form-control" name="field">
                @if (request('mould') === 'Post' || request('mid') === '1')
                    <option value="b_name" {{request()->has('field') && request()->get('field') == 'b_name' ? 'selected' : ''}}>书名</option>
                    <option value="b_auther" {{request()->has('field') && request()->get('field') == 'b_auther' ? 'selected' : ''}}>作者</option>
                    <option value="b_cate_number" {{request()->has('field') && request()->get('field') == 'b_cate_number' ? 'selected' : ''}}>分类号</option>
                    <option value="b_isbn" {{request()->has('field') && request()->get('field') == 'b_isbn' ? 'selected' : ''}}>ISBN</option>
                    <option value="b_summary" {{request()->has('field') && request()->get('field') == 'b_summary' ? 'selected' : ''}}>摘要</option>
                    <option value="all" {{request()->has('field') && request()->get('field') == 'all' ? 'selected' : ''}}>综合</option>
                    @else
                    <option value="title" {{request()->has('field') && request()->get('field') == 'title' ? 'selected' : ''}}>标题</option>
                    <option value="author" {{request()->has('field') && request()->get('field') == 'author' ? 'selected' : ''}}>作者</option>
                    <option value="source" {{request()->has('field') && request()->get('field') == 'source' ? 'selected' : ''}}>来源</option>
                    <option value="summary" {{request()->has('field') && request()->get('field') == 'summary' ? 'selected' : ''}}>摘要</option>
                    <option value="all" {{request()->has('field') && request()->get('field') == 'all' ? 'selected' : ''}}>综合</option>
                @endif

			</select>
            <input type="text" class="form-control" name="query" value="{{request()->has('query') ? request()->get('query') : ''}}">
            <button class="btn btn-success"><i class="fa fa-search" style="margin-top: -5px;"></i></button>

        </div>
		@endif
                </form>
        </div>
    </div>
    <div class="d-flex align-items-center">
        <span class="mr-5" style="color: #05c591;font-size: .9rem;display: inline-block;">欢迎 {{config('system_config.site_user_name')}}</span>
        <div>
            
            @if (auth('member')->check())
                <a href="{{route('home.browser.list')}}" class="btn btn-sm btn-custom mr-2"><i class="fa fa-clock-o mr-1"></i>浏览历史</a>
                <a href="{{route('home.member.logout')}}" class="btn btn-sm btn-warning"><i class="fa fa-sign-out mr-1"></i>退出登录</a>
            @else
                <a class="mr-2" href="{{route('home.member.login')}}">登录</a>
                <a href="{{route('home.member.register')}}">注册</a>
            @endif
        </div>
    </div>
</nav>
@if (isset($subCate))
   <div class="container-fluid">
       <div class="row mb-3 pt-3 pb-3 app-sub-nav">
           <div class="col-12">
               <div class="app-sub-nav-box" style="max-height: 49px;">
                   @if (count($subCate)>0)
                       @foreach ($subCate as $v)
                           @if($loop->first)
                               <a href="{{route('home.content',['mould'=>\Illuminate\Support\Str::studly($v->mould->table_name),'alias'=>$v->alias,'mid'=>$v->mould->id,'id'=>$v->id, 'number'=>config('base_config.page_number'),
                        'order'=>'title_asc'])}}" class="mr-1 animal" style="font-weight:bold;">{{$v->title}}</a>>
                           @else
                               <a href="{{route('home.content',['mould'=>\Illuminate\Support\Str::studly($v->mould->table_name),'alias'=>$v->alias,'mid'=>$v->mould->id,'id'=>$v->id, 'number'=>config('base_config.page_number'),
                        'order'=>'title_asc'])}}" class="mr-3 animal">{{$v->title}}</a>
                           @endif

                       @endforeach
                   @else
                       暂无分类
                   @endif
               </div>
               <div class="app-sub-m"><i class="fa fa-angle-double-down"></i></div>
           </div>

       </div>
   </div>
@endif
</div>
@yield('content')

<footer class="text-center text-muted mt-3 bg-light pt-2 pb-1 border-top">
	 <div class="d-flex justify-content-center text-muted">
	    <a href="{{route('home.page',['alias'=>'contact_us'])}}">联系我们</a><span>&nbsp;|&nbsp;</span>
	    <a href="{{route('home.message')}}">意见建议</a><span>&nbsp;|&nbsp;</span>
	    <a href="{{route('home.page',['alias'=>'help'])}}">使用帮助</a><span>&nbsp;|&nbsp;</span>
	    <a href="{{route('home.tool')}}">工具软件</a>
	    <br>
	</div>
    {!! block(6) !!}
</footer>
<script src="{{asset('frontend/js/jquery.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('static/layer/layer.js')}}"></script>
<script>
    $(function () {
        @if (isset($subCate))
        $('body').css('paddingTop',parseInt($('#nav').height())+parseInt($('.app-sub-nav').height())+55+'px');
        @else
        $('body').css('paddingTop',$('#nav').height()+25+'px');
        @endif
    });
    @if(count($errors)>0)
        var html='';
        @foreach($errors->all() as $error)
            html+='<p class="mb-0">{{$error}}</p>';
        layer.msg(html, {icon: 5,offset:'50px'});
        @endforeach
    @endif
    //信息提示
    @if(session('status'))
    layer.msg("{{session('status')}}", {icon: 6,offset:'50px'});
        @endif
        @if (session()->has('successMsg'))
    var msg = "{{session()->get('successMsg')}}";
    layer.msg(msg, {icon: 6,offset:'50px'});
    @endif
</script>
@yield('js')
</body>
</html>
