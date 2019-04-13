@extends ('layouts.skeleton')

@section ('title', __('503 Service Unavailable'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h1 class="float-left display-3 mr-4">503</h1>
                    <h4 class="pt-3">@lang ('Currently under system maintenance.')</h4>
                    <p class="text-muted">
                        <a href="{{ route('home') }}">@lang ('Return to home')</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
