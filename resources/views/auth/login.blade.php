@extends ('layouts.skeleton')

@section ('title', __('Sign In'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="clearfix">
                    <h2>
                        <i class="fa fa-sign-in fa-fw"></i>
                        @lang ('Sign In')
                    </h2>
                    <p class="text-muted">@lang ('Please enter your registered e-mail address and password.')</p>
                </div>

                @component ('components.messages.alerts') @endcomponent

                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="input-prepend input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="icon-user"></i>
                            </span>
                        </div>
                        <input name="email" type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required autofocus />
                        @include ('components.messages.invalid', ['name' => 'email'])
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="icon-lock"></i>
                            </span>
                        </div>
                        <input name="password" type="password" value="" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="@lang ('Password')" required />
                        @include ('components.messages.invalid', ['name' => 'password'])
                    </div>

                    <div class="input-prepend input-group mt-2">
                        <button class="btn btn-block btn-outline-primary px-4" type="{{ empty($demo) ? 'submit' : 'button' }}">
                            @lang ('Login')
                        </button>
                    </div>
                </form>

                <a href="{{ route('password.request') }}" class="btn btn-block btn-link px-0">
                    @lang ('Forgot password?')
                </a>
            </div>
        </div>
    </div>
@endsection
