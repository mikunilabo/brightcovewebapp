@extends ('layouts.skeleton')

@section ('title', __('Reset Password'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <form action="{{ route('password.email') }}" method="POST">
                        {{ csrf_field() }}

                        <div class="card-body p-4">
                            <h1 class="mb-3">
                                <i class="fa fa-send fa-fw"></i>@lang ('Reset Password')
                            </h1>
                            <p class="text-muted">@lang ('Please enter your registered e-mail address.')</p>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                            @endif

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input name="email" type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required autofocus />

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-block btn-outline-warning mt-2" type="{{ empty($demo) ? 'submit' : 'button' }}">
                                @lang ('Submit')
                            </button>
                            <a href="{{ route('login') }}" class="btn btn-block btn-link px-0">
                                @lang ('Back to sign in page.')
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
