@component ('components.styles') @endcomponent
@component ('components.scripts') @endcomponent

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keyword" content="">

<title>@yield ('title') - {{ config('app.name') }}</title>

<!-- Styles -->
@section ('styles')
    @stack ('styles.app')
@show

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons/apple-touch-icon.png') }}">
<link rel="apple-touch-icon-precomposed" href="{{ asset('images/icons/apple-touch-icon.png') }}">
<link rel="icon" sizes="192x192" href="{{ asset('images/icons/apple-touch-icon.png') }}">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@stack ('scripts.csrf')

<!-- Global site tag (gtag.js) - Google Analytics -->
@stack ('scripts.analytics')
