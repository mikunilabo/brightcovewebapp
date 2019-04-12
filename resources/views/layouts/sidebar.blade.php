<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-speedometer"></i>@lang ('Dashboard')
                </a>
            </li>

            <li class="nav-title">@lang ('Main menu')</li>

            <!-- Media -->
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-playlist"></i>@lang ('Media')
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="#"> <i
                            class="nav-icon icon-list"></i>@lang ('Media list')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> <i
                            class="nav-icon icon-cloud-upload"></i>@lang ('Media upload')
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Accounts -->
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon icon-people"></i>@lang ('Accounts')
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="#"> <i
                            class="nav-icon icon-list"></i>@lang ('Accounts list')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> <i
                            class="nav-icon icon-user-follow"></i>@lang ('Create account')
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
