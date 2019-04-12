<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="nav-icon icon-speedometer"></i>@lang ('Dashboard')
                </a>
            </li>

            <li class="nav-title">@lang ('Main menu')</li>

            @can ('authorize', ['media-select', 'media-upload'])
                <!-- Media -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-playlist"></i>@lang ('Media')
                    </a>
                    <ul class="nav-dropdown-items">
                        @can ('authorize', ['media-select'])
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="nav-icon icon-list"></i>@lang ('Media list')
                                </a>
                            </li>
                        @endcan

                        @can ('authorize', ['media-upload'])
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="nav-icon icon-cloud-upload"></i>@lang ('Media upload')
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can ('authorize', ['account-select', 'account-create'])
                <!-- Accounts -->
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#">
                        <i class="nav-icon icon-people"></i>@lang ('Accounts')
                    </a>
                    <ul class="nav-dropdown-items">
                        @can ('authorize', ['account-select'])
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="nav-icon icon-list"></i>@lang ('Accounts list')
                                </a>
                            </li>
                        @endcan

                        @can ('authorize', ['account-create'])
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="nav-icon icon-user-follow"></i>@lang ('Create account')
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
