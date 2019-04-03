<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section('head')
        @include ('layouts.head')
    @show

    @include ('layouts.analytics')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @section('header')
        @include ('layouts.header')
    @show

    <div class="app-body">
        @section('sidebar')
            @include ('layouts.sidebar')
        @show

        @yield('content')

        @section('aside')
            @include ('layouts.aside')
        @show
    </div>

    @section('footer')
        @include ('layouts.footer')
    @show

    @section('scripts')
        @include ('layouts.scripts')
    @show
</body>
</html>
