@extends ('layouts.skeleton')

@section ('title', __('Create Account'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="clearfix">
                    <div>
                        <img class="navbar-brand-full" src="{{ asset('images/brand/logo_full.png') }}" width="100%" height="auto" alt="{{ config('app.name') }}">
                    </div>
                    <h2 class="text-center mt-3">
                        <i class="icons icon-user-follow"></i> @lang ('Sign Up')
                    </h2>
                    <p class="text-muted mt-3">@lang ('Please enter your name, e-mail address, and password.')</p>
                </div>

                @component ('components.messages.alerts') @endcomponent

                <form action="{{ route('register') }}" method="POST" onsubmit="window.Common.overlay();">
                    {{ csrf_field() }}

                    <div class="input-prepend input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-user"></i></span>
                        </div>

                        @set ($attribute, 'name')
                        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Name')" required autofocus />
                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</i>
                            </span>
                        </div>

                        @set ($attribute, 'email')
                        <input name="{{ $attribute }}" type="email" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('E-Mail')" required />
                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>

                        @set ($attribute, 'password')
                        <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Password')" required />
                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>

                        @set ($attribute, 'password_confirmation')
                        <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Repeat Password')" required />
                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                    </div>

                    <div class="input-prepend input-group mt-2">
                        <button class="btn btn-block btn-outline-success" type="submit">
                            @lang ('Create Account')
                        </button>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="btn btn-block btn-link px-0 mt-3">
                    @lang ('Already have a account? Sign in!')
                </a>

                @component ('layouts.skeleton_footer') @endcomponent
            </div>
        </div>
    </div>
@endsection
