@push ('scripts.app')
    <script type="text/javascript" src="{{ asset(mix('js/manifest.js')) }}"></script>
    <script type="text/javascript" src="{{ asset(mix('js/vendor.js')) }}"></script>
    <script type="text/javascript" src="{{ asset(mix('js/app.js')) }}"></script>
@endpush

@push ('scripts.const')
    <script type="text/javascript">
        const VALID_VIDEO_FILE_SIZE = 10737418240;// 10GB
    </script>
@endpush

@push ('scripts.csrf')
    <script>
        window.Laravel = @json(['csrfToken' => csrf_token()]);
    </script>
@endpush

@push ('scripts.analytics')

@endpush

@push ('scripts.typeaheadjs')
    <script src="{{ asset('js/typeahead.bundle.min.js') }}" type="text/javascript"></script>
@endpush

@push ('scripts.resources')
    <script type="text/javascript">
        window.lang = @json (json_decode(file_get_contents(resource_path('lang/ja.json')), true));
    </script>
@endpush
