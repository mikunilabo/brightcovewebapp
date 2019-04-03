@extends('layouts.skeleton')

@section('title', __('Create Account'))

@section('content')
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card mx-4">
            <form action="{{ route('register') }}" method="POST">
                {{ csrf_field() }}

                <div class="card-body p-4">
                  <h1>@lang ('Sign Up')</h1>
                  <p class="text-muted mt-3 lead" style="cursor: pointer;" data-container="body" data-toggle="popover" data-html="true" data-placement="top" data-content="<mark>@lang ('Account registration is possible, but the email address is unauthorized user.')</mark>">
                      <i class="icons cui-magnifying-glass"></i>
                      @lang ('About demo registration')
                  </p>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-user"></i>
                      </span>
                    </div>
                    <input name="name" type="text" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="@lang ('Username')" required autofocus />
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>
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
                      <span class="input-group-text">
                        <i class="icon-lock"></i>
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
                      <span class="input-group-text">
                        <i class="icon-lock"></i>
                      </span>
                    </div>
                    <input name="password_confirmation" type="password" value class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="@lang ('Repeat password')" required />
                  </div>

                  <button class="btn btn-block btn-outline-success" type="{{ empty($demo) ? 'submit' : 'button' }}">@lang ('Create Account')</button>
                  <a href="{{ route('login') }}" class="btn btn-block btn-link px-0 mt-3">@lang ('Already have a account? Sign in!')</a>
                </div>
            </form>
            <div class="card-footer p-4">
              <div class="row">
                <div class="col-6">
                  <button class="btn btn-block btn-google-plus" type="button">
                    <i class="fa fa-google-plus"></i><span> Google</span>
                  </button>
                  <button class="btn btn-block btn-facebook" type="button">
                    <i class="fa fa-facebook"></i><span> Facebook</span>
                  </button>
                </div>
                <div class="col-6">
                  <button class="btn btn-block btn-twitter" type="button">
                    <i class="fa fa-twitter"></i><span> Twitter</span>
                  </button>
                  <button class="btn btn-block btn-dark" type="button">
                    <i class="fa fa-github"></i><span> GitHub</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
