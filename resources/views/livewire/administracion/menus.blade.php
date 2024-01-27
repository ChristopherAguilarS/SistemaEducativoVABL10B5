
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo_vab_icono.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo_vab.png') }}" alt="" height="40">
                <img src="{{ URL::asset('build/images/logo_vab_icono2.png') }}" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo_vab_icono.png') }}" alt="" height="40">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo_vab_icono.png') }}" alt="" height="40">
                <img src="{{ URL::asset('build/images/logo_vab_icono2.png') }}" alt="" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span>{{$modulo}}
                    </span></li>
                <li class="nav-item">
                    @foreach($menus as $menu)
                        @if($menu['tipo'])
                            <a class="nav-link menu-link" href="#sidebar{{ $menu['vista'] }}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebar{{$menu['vista']}}">
                                <i class="mdi {{$menu['icon']}}"></i> <span>{{$menu['nombre']}}</span>
                            </a>

                            <div class="collapse menu-dropdown {{ $prefix === $url.'/'.$menu['vista'] ? 'show' : ''}}" id="sidebar{{$menu['vista']}}">
                                <ul class="nav nav-sm flex-column">
                                    @foreach($menu['detalle'] as $submenu)
                                        <li class="nav-item">
                                            <a href="{{ route($url.'/'.$menu['vista'].'/'.$submenu['vista']) }}" class="nav-link {{ request()->routeIs($url.'/'.$menu['vista'].'/'.$submenu['vista']) ? 'active' : '' }}" data-key="t-{{$submenu['vista']}}">{{$submenu['nombre']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <a class="nav-link menu-link {{ request()->routeIs($url.'/'.$menu['vista']) ? 'active' : '' }}" href="{{ route($url.'/'.$menu['vista']) }}">
                                <i class="mdi {{$menu['icon']}}"></i> <span>{{$menu['nombre']}}</span>
                            </a>
                        @endif
                    @endforeach
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
