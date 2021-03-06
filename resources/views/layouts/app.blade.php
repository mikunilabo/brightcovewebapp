<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section ('head')
        @include ('layouts.head')
    @show
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @section ('header')
        @include ('layouts.header')
    @show

    <div class="app-body">
        @section ('sidebar')
            @include ('layouts.sidebar')
        @show

        @yield ('content')

        @section ('aside')
            @include ('layouts.aside')
        @show
    </div>

    @section ('footer')
        @component ('layouts.footer') @endcomponent
    @show

    @component ('components.forms.basic') @endcomponent
    @component ('components.overlay.loading') @endcomponent
    @component ('components.overlay.progress') @endcomponent

    @section ('scripts')
        @stack ('scripts.const')
        @stack ('scripts.user')
        @stack ('scripts.app')
        @stack ('scripts.resources')
    @show
</body>
</html>
