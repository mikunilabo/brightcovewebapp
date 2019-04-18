<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @section ('head')
        @include ('layouts.head')
    @show
</head>
<body class="app flex-row align-items-center">
    @yield ('content')

    @component ('components.forms.basic') @endcomponent

    @section ('scripts')
        @stack ('scripts.app')
    @show
</body>
</html>
