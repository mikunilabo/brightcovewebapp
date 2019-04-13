@extends ('layouts.skeleton')

@section ('title', __('404 Not found'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h1 class="float-left display-3 mr-4">404</h1>
                    <h4 class="pt-3">@lang ('The page you are looking for was not found.')</h4>
                    <p class="text-muted">
                        <a href="{{ route('home') }}">@lang ('Return to home')</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
