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
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                @if (false)<img class="img-avatar" src="{{ asset('img/avatars/6.jpg') }}" alt="">@endif
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Account</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-bell-o"></i>Updates
                    <span class="badge badge-info">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-envelope-o"></i>Messages
                    <span class="badge badge-success">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-tasks"></i>Tasks
                    <span class="badge badge-danger">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-comments"></i>Comments
                    <span class="badge badge-warning">42</span>
                </a>

                <div class="dropdown-header text-center">
                    <strong>Settings</strong>
                </div>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-user"></i>Profile
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-wrench"></i>Settings
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-usd"></i>Payments <span class="badge badge-secondary">42</span>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-file"></i>Projects <span class="badge badge-primary">42</span>
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="#">
                    <i class="fa fa-shield"></i>Lock Account
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('@lang(" Do you want to log out?")')) document.getElementById('logout-form').submit(); returnfalse;">
                    <i class="fa fa-lock"></i>{{ __('Logout') }}
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
