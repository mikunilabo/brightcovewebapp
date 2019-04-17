@push ('scripts.app')
    <script type="text/javascript" src="{{ asset(mix('js/manifest.js')) }}"></script>
    <script type="text/javascript" src="{{ asset(mix('js/vendor.js')) }}"></script>
    <script type="text/javascript" src="{{ asset(mix('js/app.js')) }}"></script>
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
