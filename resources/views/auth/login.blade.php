@extends ('layouts.skeleton')

@section ('title', __('Sign In'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="clearfix">
                    <div>
                        <img class="navbar-brand-full" src="{{ asset('images/brand/logo_full.png') }}" width="100%" height="auto" alt="{{ config('app.name') }}">
                    </div>
                    <h2 class="text-center mt-3">
                        <i class="icons icon-lock-open"></i> @lang ('Sign In')
                    </h2>
                    <p class="text-muted mt-3">@lang ('Please enter your registered e-mail address and password.')</p>
                </div>

                @component ('components.messages.alerts') @endcomponent

                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="input-prepend input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="icon-user"></i>
                            </span>
                        </div>

                        @set ($attribute, 'email')
                        <input name="{{ $attribute }}" type="email" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required autofocus />
                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="icon-lock"></i>
                            </span>
                        </div>

                        @set ($attribute, 'password')
                        <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required />
                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                    </div>

                    <div class="input-prepend input-group mt-2">
                        <button class="btn btn-block btn-outline-primary px-4" type="submit">
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
