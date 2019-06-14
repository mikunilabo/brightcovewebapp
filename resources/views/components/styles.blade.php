@push ('styles.app')
    @if (file_exists(public_path('mix-manifest.json')))
        <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/default.css') }}" rel="stylesheet">
    @endif
@endpush
