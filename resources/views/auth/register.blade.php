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

                        @set ($attribute, 'name')
                        <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required autofocus />
                        @include ('components.messages.invalid', ['name' => $attribute])
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="icon-user"></i>
                            </span>
                        </div>

                        @set ($attribute, 'email')
                        <input name="{{ $attribute }}" type="email" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required />
                        @include ('components.messages.invalid', ['name' => $attribute])
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>

                        @set ($attribute, 'password')
                        <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required />
                        @include ('components.messages.invalid', ['name' => $attribute])
                    </div>

                    <div class="input-prepend input-group mt-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-lock"></i></span>
                        </div>

                        @set ($attribute, 'password_confirmation')
                        <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required />
                        @include ('components.messages.invalid', ['name' => $attribute])
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
            </div>
        </div>
    </div>
@endsection
