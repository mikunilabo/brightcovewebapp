<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="description" content="Mikunilabo Admin Demo">
<meta name="author" content="Kuniyasu Wada">
<meta name="keyword" content="">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

<!-- Styles -->
<link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

<!-- Favicon -->
<link type="image/vnd.microsoft.icon" rel="shortcut icon" href="{{ asset(sprintf('images/favicon/%s', app()->isLocal() ? 'favicon.local.ico' : 'favicon.ico')) }}" />

<script>
    window.Laravel = @json(['csrfToken' => csrf_token()]);
</script>
