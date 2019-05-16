@extends ('layouts.skeleton')

@section ('title', __('Reset Password'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="clearfix">
                    <div>
                        <img class="navbar-brand-full" src="{{ asset('images/brand/logo_full.png') }}" width="100%" height="auto" alt="{{ config('app.name') }}">
                    </div>
                    <h2 class="text-center mt-3">
                        <i class="icons icon-paper-plane"></i> @lang ('Reset Password')
                    </h2>
                    <p class="text-muted mt-3">@lang ('Please enter your registered e-mail address.')</p>
                </div>

                @component ('components.messages.alerts') @endcomponent

                <form action="{{ route('password.email') }}" method="POST" onsubmit="window.Common.overlay();">
                    {{ csrf_field() }}

                    <div class="input-prepend input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="icon-user"></i>
                            </span>
                        </div>

                        @set ($attribute, 'email')
                        <input name="{{ $attribute }}" type="email" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="@lang ('E-Mail')" required autofocus />
                        @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                    </div>

                    <div class="input-prepend input-group">
                        <button class="btn btn-block btn-outline-warning mt-2" type="submit">
                            @lang ('Submit')
                        </button>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="btn btn-block btn-link px-0">
                    @lang ('Back to sign in page.')
                </a>

                @component ('layouts.skeleton_footer') @endcomponent
            </div>
        </div>
    </div>
@endsection
