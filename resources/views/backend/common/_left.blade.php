<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu" id="side-menu">
                <li class="menu-title">Navigation</li>
                @foreach($adminMenu as $v)
                    @if(count($v->children) > 0)
                        @canany(getPermissionNames($v->children))
                        <li>
                            <a href="javascript: void(0);" class="waves-effect">
                                <i class="{{$v->icon_class}}"></i>
                                <span> {{$v->title}} </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" aria-expanded="false">
                                @foreach($v->children as $c)
                                    @can(\Illuminate\Support\Str::replaceFirst('.','_',$c->route))
                                    <li class="">
                                        <a href="{{$c->route != '' ? route($c->route) : 'javascript:;'}}"
                                           class="">{{$c->title}}</a>
                                    </li>
                                    @endcan
                                @endforeach
                            </ul>
                        </li>
                            @endcanany
                    @else
                        @can(\Illuminate\Support\Str::replaceFirst('.','_',$v->route))
                        <li class="">
                            <a href="{{$v->route != '' ? route($v->route) : route('backend.home')}}" class="">
                                <i class="{{$v->icon_class}}"></i>
                                <span>{{$v->title}}{{$v->route}}</span>
                            </a>
                        </li>
                        @endcan
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
