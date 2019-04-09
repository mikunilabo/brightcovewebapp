@extends ('layouts.skeleton')

@section ('title', __('Reset Password'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h2>
                        <i class="fa fa-send fa-fw"></i>
                        @lang ('Reset Password')
                    </h2>
                    <p class="text-muted">@lang ('Please enter your registered e-mail address.')</p>
                </div>

                @component ('components.messages.alerts') @endcomponent

                <form action="{{ route('password.email') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="input-prepend input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="icon-user"></i>
                            </span>
                        </div>
                        <input name="email" type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required autofocus />
                        @include ('components.messages.invalid', ['name' => 'email'])
                    </div>

                    <div class="input-prepend input-group">
                        <button class="btn btn-block btn-outline-warning mt-2" type="{{ empty($demo) ? 'submit' : 'button' }}">
                            @lang ('Submit')
                        </button>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="btn btn-block btn-link px-0">
                    @lang ('Back to sign in page.')
                </a>
            </div>
        </div>
    </div>
@endsection
