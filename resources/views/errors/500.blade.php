@extends ('layouts.skeleton')

@section ('title', __('500 Internal Server Error'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h1 class="float-left display-3 mr-4">500</h1>
                    <h4 class="pt-1">@lang ('An internal server error has occurred.')</h4>
                    <p class="text-muted">
                        @lang ('Please contact the administrator.')<br>
                        <a href="{{ route('home') }}">@lang ('Return to home')</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
