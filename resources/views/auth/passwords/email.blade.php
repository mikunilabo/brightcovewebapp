@extends ('layouts.skeleton')

@section ('title', __('Reset Password'))

@section ('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="clearfix">
                    <h2>
                        <i class="fa fa-send fa-fw"></i>
                        @lang ('Reset Password')
                    </h2>
                    <p class="text-muted">@lang ('Please enter your registered e-mail address.')</p>
                </div>

                @component ('components.messages.alerts') @endcomponent

                <form action="{{ route('password.email') }}" method="POST">
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

                    <div class="input-prepend input-group">
                        <button class="btn btn-block btn-outline-warning mt-2" type="submit">
                            @lang ('Submit')
                        </button>
                    </div>
                </form>

                <a href="{{ route('login') }}" class="btn btn-block btn-link px-0">
                    @lang ('Back to sign in page.')
                </a>
            </div>
        </div>
    </div>
@endsection
