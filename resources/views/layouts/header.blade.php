<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route('home') }}">
        <img src="{{ config('resources.images.logo_full') }}" class="navbar-brand-full" width="145" height="auto" alt="{{ config('app.name') }}">
        <img src="{{ config('resources.images.logo') }}" class="navbar-brand-minimized" width="25" height="25" alt="{{ config('app.name') }}">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-auto">
        @if (false)
            <li class="nav-item dropdown d-md-down-none">
                <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="icons icon-bell"></i>
                    <span class="badge badge-pill badge-danger">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                    <div class="dropdown-header text-center">
                        <strong>You have 4 messages</strong>
                    </div>

                    @for ($i = 0; $i < 4; $i++)
                        <a class="dropdown-item" href="#">
                            <div class="message">
                                <div class="py-2 mr-3 float-left">
                                    <div class="avatar">
                                        <img class="img-avatar" src="{{ config('resources.images.logo') }}" alt="">
                                        <span class="avatar-status badge-info"></span>
                                    </div>
                                </div>
                                <div>
                                    <small class="text-muted">Sender name</small>
                                    <small class="text-muted float-right mt-1">Just now</small>
                                </div>
                                <div class="text-truncate font-weight-bold">
                                    Title
                                </div>
                                <div class="small text-muted text-truncate">Contents...</div>
                            </div>
                        </a>
                    @endfor

                    <a class="dropdown-item text-center" href="#">
                    <strong>View all messages</strong>
                    </a>
                </div>
            </li>
        @endif

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="{{ route('accounts.profile') }}">
                    <i class="nav-icon icon-user"></i>@lang ('Profile')
                </a>
                <a class="dropdown-item" href="#">
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
