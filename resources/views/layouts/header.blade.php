<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ config('resources.images.logo_full') }}" class="navbar-brand-full" width="150" height="auto" alt="{{ config('app.name') }}">
        <img src="{{ config('resources.images.logo') }}" class="navbar-brand-minimized" width="35" height="auto" alt="{{ config('app.name') }}">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img class="img-avatar" src="{{ sprintf('https://www.gravatar.com/avatar/%s?d=mp&s=35', Util::md5ForGravatar(Auth::user()->email)) }}" width="35" height="auto" alt="{{ Auth::user()->email }}">
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('accounts.profile') }}">
                    <i class="nav-icon icon-user"></i>@lang ('Profile')
                </a>

                <a class="dropdown-item disabled" href="#">
                    <i class="nav-icon icon-settings"></i>@lang ('Settings')
                </a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); if (confirm('@lang("Do you want to log out?")')) { window.Common.submitForm('{{ route('logout') }}'); } return false;">
                    <i class="nav-icon icon-power"></i>@lang ('Logout')
                </a>
            </div>
        </li>
    </ul>

    <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>
