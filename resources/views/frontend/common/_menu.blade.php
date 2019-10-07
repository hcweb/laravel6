<div class="leftMenu">
    <div class="one hasSubMenu">
        <i class="iconfont icon-cate" style="font-size: 23px;" title="导航"></i>
        @if (isset($menus) && count($menus) > 0)
        <div id="main-menu" class="leftMenuBox bg-white" style="width: 700px;right: -700px;max-height: 400px;overflow: hidden;overflow-y: auto;">
            @foreach ($menus as $v)
                <dl class="d-flex mb-0">
                    <dt style="background: #D8E8E5;width: 150px;" class="p-2 text-black-50">
						<a href="{{route('home.content',['mould'=>\Illuminate\Support\Str::studly($v->mould->table_name),'alias'=>$v->alias,'mid'=>$v->mould->id,'id'=>$v->id, 'number'=>config('base_config.page_number'),
                        'order'=>'title_asc'])}}">{{$v->title}}</a>
						<span class="fa fa-play ml-1" style="font-size: 12px;"></span></dt>
                    @if (count(getAllSubMenuById($v->id)) > 0)
                        <dd class="p-2" style="border-bottom: 1px dashed #ccc;">
                            @else
                        <dd class="p-2">
                    @endif
                        @foreach(getAllSubMenuById($v->id) as $m)
                        <a href="{{route('home.content',['mould'=>\Illuminate\Support\Str::studly($m->mould->table_name),'alias'=>$m->alias,'mid'=>$m->mould->id,'id'=>$m->id, 'number'=>config('base_config.page_number'),
                        'order'=>'title_asc'])}}" class="text-black ml-1 mr-1 animal">{{$m->title}}</a>
                        @endforeach
                    </dd>
                </dl>
            @endforeach
        </div>
        @endif
    </div>
    <a href="#" class="one hasSubMenu" title="微信公众平台">
        <i class="iconfont icon-erweima_" style="font-size: 23px;"></i>
        <div class="leftMenuBox">
            <img src="{!! block(7) !!}" alt="">
        </div>
    </a>
    <a href="{{route('home.page',['alias'=>'help'])}}" class="one" title="使用帮助"><i class="iconfont icon-wenhao" style="font-size: 23px;"></i></a>
    <a href="#" class="one" title="热门资源"><i class="iconfont icon-remen" style="font-size: 23px;"></i></a>

    <a href="{{url()->current()}}"  class="mt-3 one" title="第一页"><i class="fa fa-angle-double-up"></i></a>
    <a href="javascript:;"  class="one prePage" title="上一页"><i class="fa fa-angle-up"></i></a>
    <a href="javascript:;"  class="one nextPage" title="下一页"><i class="fa fa-angle-down"></i></a>

</div>

<div class="rightMenu">
    <div class="one hasSubMenu" style="opacity: 0">
        <i class="iconfont icon-cate" style="font-size: 23px;" title="导航"></i>
    </div>
    <a href="#" class="one hasSubMenu" title="微信公众平台" style="opacity: 0">
        <i class="iconfont icon-erweima_" style="font-size: 23px;"></i>
    </a>
    <a style="opacity: 0" href="{{route('home.page',['alias'=>'help'])}}" class="one" title="使用帮助"><i class="iconfont icon-wenhao" style="font-size: 23px;"></i></a>
    <a style="opacity: 0" href="#" class="one" title="热门资源"><i class="iconfont icon-remen" style="font-size: 23px;"></i></a>

    <a href="{{url()->current()}}"  class="mt-3 one" title="第一页"><i class="fa fa-angle-double-up"></i></a>
    <a href="javascript:;"  class="one prePage" title="上一页"><i class="fa fa-angle-up"></i></a>
    <a href="javascript:;"  class="one nextPage" title="下一页"><i class="fa fa-angle-down"></i></a>

</div>
