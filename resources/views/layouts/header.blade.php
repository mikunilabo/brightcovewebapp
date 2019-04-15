<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}">
        {{ config('app.name') }}

        @if (false)
            <img class="navbar-brand-full" src="{{ asset('img/brand/logo.svg') }}" width="89" height="25" alt="">
            <img class="navbar-brand-minimized" src="{{ asset('img/brand/sygnet.svg') }}" width="30" height="30" alt="">
        @endif
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    @if (false)
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Menu1</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Menu2</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Menu3</a>
            </li>
        </ul>
    @endif

    <ul class="nav navbar-nav ml-auto">
        @if (false)
            <li class="nav-item d-md-down-none">
                <a class="nav-link" href="#">
                    <i class="icon-bell"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
            </li>
        @endif

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>

                @if (false)<img class="img-avatar" src="{{ asset('img/avatars/6.jpg') }}" alt="">@endif
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">
                    <i class="nav-icon icon-user"></i>@lang ('Profile')
                </a>
                <a class="dropdown-item" href="#">
                    <i class="nav-icon icon-settings"></i>@lang ('Settings')
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('@lang("Do you want to log out?")')) document.getElementById('logout-form').submit(); return false;">
                    <i class="nav-icon icon-lock"></i>@lang ('Logout')
                </a>
            </div>
        </li>
    </ul>

    <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
        {{ csrf_field() }}
    </form>

    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>
