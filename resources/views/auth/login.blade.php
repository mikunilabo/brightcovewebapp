@extends('layouts.skeleton')

@section('title', __('Sign In'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-group">
                    <div class="card p-4">
                        <form action="{{ route('login') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="card-body">
                                <h1 class="mb-3">
                                    <i class="fa fa-sign-in fa-fw"></i>@lang ('Sign In')
                                </h1>

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="icon-user"></i>
                                        </span>
                                    </div>
                                    <input name="email" type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required autofocus />

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="icon-lock"></i>
                                        </span>
                                    </div>
                                    <input name="password" type="password" value="" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="@lang ('Password')" required />

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-1">
                                        <label class="switch switch-pill switch-outline-success">
                                            <input name="remember" type="checkbox" id="remember" class="switch-input" {{ old('remember') ? 'checked' : '' }} />
                                            <span class="switch-slider"></span>
                                        </label>
                                    </div>
                                    <div class="col-10">
                                        <label for="remember">
                                            <p class="text-muted">&nbsp;@lang ('Remember Me')</p>
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-outline-primary px-4" type="{{ empty($demo) ? 'submit' : 'button' }}">@lang ('Login')</button>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <a href="{{ route('password.request') }}" class="btn btn-link px-0">@lang ('Forgot password?')</a>
                                    </div>

                                    @if (false)
                                        <div class="col-12 d-md-none">
                                            <a href="{{ route('register') }}" class="btn btn-link px-0">@lang ('Do not have a account? Sign Up!')</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
