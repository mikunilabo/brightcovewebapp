@extends ('layouts.app')

@section ('title', __('Create Account'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Create Account') => route('accounts.create')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('accounts.create') }}" method="POST" onsubmit="window.Common.overlay();">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Create Account')
                                </div>
                                <div class="card-body">
                                    @component ('components.messages.alerts') @endcomponent

                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            @set ($attribute, 'name')
                                            <label for="{{ $attribute }}">@lang ('Name') <code>*</code></label>
                                            <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" autocomplete="off" required autofocus />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                        <div class="form-group col-sm-6">
                                            @set ($attribute, 'company')
                                            <label for="{{ $attribute }}">@lang ('Company')</label>
                                            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" autocomplete="off" />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            @set ($attribute, 'email')
                                            <label for="{{ $attribute }}">@lang ('E-Mail') <code>*</code></label>
                                            <input name="{{ $attribute }}" type="email" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="255" placeholder="" required />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                        <div class="form-group col-sm-6">
                                            @set ($attribute, 'role_id')
                                            <label for="{{ $attribute }}">@lang ('Role') <code>*</code></label>
                                            <select name="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" required>
                                                @foreach ($vc_roles->pluck('name', 'id') as $key => $value)
                                                    <option value="{{ $key }}" {{ (int)($errors->{$errorBag ?? 'default'}->any() ? old($attribute) : 2) === (int)$key ? 'selected' : '' }}>{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            @set ($attribute, 'password')
                                            <label for="{{ $attribute }}">@lang ('Password') <code>*</code></label>
                                            <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="16" placeholder="@lang ('Please enter.')" required />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            <span class="form-text text-muted">@lang ('Please enter characters that are hard to guess by others among 8 to 16 characters.')</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            @set ($attribute, 'password_confirmation')
                                            <label for="{{ $attribute }}">@lang ('Repeat Password') <code>*</code></label>
                                            <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" maxlength="16" placeholder="@lang ('Please re-enter to confirm.')" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'leagues')
                                            <label for="{{ $attribute }}">@lang ('Leagues')</label>

                                            @component ('components.popovers.informations', ['content' => sprintf('%s<br>%s',
                                                __('It will be automatically selected when uploading.'),
                                                Auth::user()->can('authorize', 'user-create') ? __('If it is not in the list, it will be newly registered.') : '')
                                            ]) @endcomponent

                                            <div class="input-group">
                                                <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ sprintf('ta-%s', $attribute) }} {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" />
                                            </div>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'universities')
                                            <label for="{{ $attribute }}">@lang ('Universities')</label>

                                            @component ('components.popovers.informations', ['content' => sprintf('%s<br>%s',
                                                __('It will be automatically selected when uploading.'),
                                                Auth::user()->can('authorize', 'user-create') ? __('If it is not in the list, it will be newly registered.') : '')
                                            ]) @endcomponent

                                            <div class="input-group">
                                                <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ sprintf('ta-%s', $attribute) }} {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" />
                                            </div>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>

                                    @set ($attribute, 'sports')
                                    @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : []])
                                </div>
                                <div class="card-footer text-center">
                                    @component ('components.buttons.back') @endcomponent

                                    @can ('authorize', 'user-create')
                                        <button class="btn btn-sm btn-warning ml-2 float-left" type="button" data-toggle="modal" data-target="#leagues-modal">
                                            <i class="icons icon-tag">@lang ('Leagues')</i>
                                        </button>

                                        <button class="btn btn-sm btn-warning ml-2 float-left" type="button" data-toggle="modal" data-target="#universities-modal">
                                            <i class="icons icon-tag">@lang ('Universities')</i>
                                        </button>

                                        <button class="btn btn-sm btn-warning ml-2 float-left" type="button" data-toggle="modal" data-target="#sports-modal">
                                            <i class="icons icon-tag">@lang ('Sports')</i>
                                        </button>
                                    @endcan

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

    @can ('authorize', 'user-create')
        @component ('components.modals.masters', ['name' => 'leagues']) @endcomponent
        @component ('components.modals.masters', ['name' => 'universities']) @endcomponent
        @component ('components.modals.masters', ['name' => 'sports']) @endcomponent
    @endcan
@endsection

@section ('scripts')
    @parent

    <script type="text/javascript">
        (function() {
            'use strict';

            ta('.ta-leagues', 'leagues');
            ta('.ta-sports', 'sports');
            ta('.ta-universities', 'universities');

            @can ('authorize', 'user-create')
                window.Common.listMasters('leagues');
                window.Common.listMasters('universities');
                window.Common.listMasters('sports');
            @endcan
        })();

        /**
         * @param string id
         * @return void
         */
        function ta(tag, name) {
            if (name === 'leagues') {
                var json = @json ($vc_leagues->pluck('name'));
            } else if (name === 'sports') {
                var json = @json ($vc_sports->pluck('name'));
            } else if (name === 'universities') {
                var json = @json ($vc_universities->pluck('name'));
            }

            $(tag).typeahead({
                highlight: true,
                hint: false,
                minLength: 0
            },
            {
                name: 'states',
                limit: 100,
                source: window.Common.substringMatcher(json)
            });
        }
    </script>
@endsection
