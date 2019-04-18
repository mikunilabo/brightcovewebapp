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
<link type="image/vnd.microsoft.icon" rel="shortcut icon" href="{{ asset(sprintf('images/favicon/%s', app()->isLocal() ? 'favicon.local.ico' : 'favicon.ico')) }}" />

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@stack ('scripts.csrf')

<!-- Global site tag (gtag.js) - Google Analytics -->
@stack ('scripts.analytics')
