@extends ('layouts.skeleton')

@section ('title', __('Create Account'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h2>
                        <i class="fa fa-send fa-fw"></i>
                        @lang ('Sign Up')
                    </h2>
                    <p class="text-muted">@lang ('Please enter your name, e-mail address, and password.')</p>
                </div>

                @component ('components.messages.alerts') @endcomponent

                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="input-prepend input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>
                        <input name="name" type="text" value="{{ old('name') }}" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="@lang ('Username')" required autofocus />
                        @include ('components.messages.invalid', ['name' => 'name'])
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="icon-user"></i>
                            </span>
                        </div>
                        <input name="email" type="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required />
                        @include ('components.messages.invalid', ['name' => 'email'])
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input name="password" type="password" value class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="@lang ('Password')" required />
                            @include ('components.messages.invalid', ['name' => 'password'])
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>
                        <input name="password_confirmation" type="password" value class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" placeholder="@lang ('Repeat password')" required />
                    </div>

                    <div class="input-prepend input-group mt-2">
                        <button class="btn btn-block btn-outline-success" type="{{ empty($demo) ? 'submit' : 'button' }}">
                            @lang ('Create Account')
                        </button>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="btn btn-block btn-link px-0 mt-3">
                    @lang ('Already have a account? Sign in!')
                </a>
            </div>
        </div>
    </div>
@endsection
