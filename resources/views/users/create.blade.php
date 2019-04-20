@extends ('layouts.app')

@section ('title', __('Create Account'))

@section ('styles')
    @parent
@endsection

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Create Account') => route('accounts.create')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('accounts.create') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Create Account')
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        @component ('components.messages.alerts') @endcomponent

                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                @set ($attribute, 'name')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute)) <code>*</code></label>
                                                <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required autofocus />
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                            <div class="form-group col-sm-6">
                                                @set ($attribute, 'company')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute))</label>
                                                <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" />
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                @set ($attribute, 'email')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute)) <code>*</code></label>
                                                <input name="{{ $attribute }}" type="email" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required />
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                            <div class="form-group col-sm-6">
                                                @set ($attribute, 'role_id')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute)) <code>*</code></label>
                                                <select name="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" required>
                                                    {{-- TODO from master table --}}
                                                    @foreach ([1 => 'Admin', 2 => 'User'] as $key => $value)
                                                        <option value="{{ $key }}" {{ (int)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : 2) === (int)$key ? 'selected' : '' }}>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6">
                                                @set ($attribute, 'password')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute)) <code>*</code></label>
                                                <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required />
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent

                                            </div>
                                            <div class="form-group col-sm-6">
                                                @set ($attribute, 'password_confirmation')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.users.%s', $attribute)) <code>*</code></label>
                                                <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang (sprintf('attributes.users.%s', $attribute))" required />
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            @set ($attribute, 'sports')
                                            <div class="form-group col-sm-12">
                                                <label for="{{ $attribute }}">@lang ('Sports')</label>
                                            </div>
                                            @for ($i = 0; $i < 3; $i++)
                                                <div class="form-group col-sm-6">
                                                    <div class="input-group">
                                                        <input name="{{ sprintf('%s[%s]', $attribute, $i) }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute)[$i] : null }}" class="typeahead form-control {{ $errors->{$errorBag ?? 'default'}->has(sprintf('%s.%s', $attribute, $i)) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" />
                                                        <span class="input-group-append">
                                                            <button class="btn btn-outline-danger" type="button">
                                                                <i class="icons icon-close"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    @component ('components.messages.invalid', ['name' => sprintf('%s.%s', $attribute, $i)])
                                                </div>
                                            @endfor
                                            <div class="form-group col-md-6">
                                                <button class="btn btn-block btn-outline-success" type="button">
                                                    <i class="icons icon-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    @component ('components.buttons.back') @endcomponent

                                    <button type="submit" class="btn btn-primary">
                                        <i class="icons icon-check"></i> @lang ('Create')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section ('scripts')
    @parent

    <script type="text/javascript">
        	$('.typeahead').typeahead({
            highlight: true,
            hint: false,
            minLength: 0
        	},
        	{
            name: 'states',
            limit: 100,
            source: window.Common.substringMatcher(@json (Auth::user()->pluck('name')->all()))
        	});
    </script>
@endsection
