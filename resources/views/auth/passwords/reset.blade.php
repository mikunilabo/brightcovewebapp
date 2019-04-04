@extends('layouts.skeleton')

@section('title', __('Reset Password'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-4">
                    <form action="{{ route('password.request') }}" method="POST">
                        <input type="hidden" name="token" value="{{ $token }}"> {{
                        csrf_field() }}

                        <div class="card-body p-4">
                            <h1 class="mb-3">
                                <i class="fa fa-refresh fa-fw"></i>@lang ('Reset Password')
                            </h1>
                            <p class="text-muted">
                                @lang ('Please enter the email address of the account you want to reset and the new password.')
                            </p>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                            @endif

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input name="email" type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required />

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input name="password" type="password" value class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="@lang ('Password')" required />

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="icon-lock"></i>
                                    </span>
                                </div>
                                <input name="password_confirmation" type="password" value class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="@lang ('Repeat password')" required />
                            </div>

                            <button class="btn btn-block btn-outline-danger" type="{{ empty($demo) ? 'submit' : 'button' }}">
                                @lang ('Reset')
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
