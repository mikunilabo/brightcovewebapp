@extends ('layouts.app')

@section ('title', __('Media Upload'))

@section ('styles')
    @parent
@endsection

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Media Upload') => route('media.upload')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Media Upload')
                                </div>
                                <div class="card-body">
                                    @component ('components.messages.alerts') @endcomponent

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'video_file')
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute)) <code>*</code></label>

                                            @component ('components.popovers.informations', ['content' => '20MB']) @endcomponent

                                            <div>
                                                <input name="{{ $attribute }}" type="file" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="{{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" required />
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>
                                    </div>

                                    @if (false)
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'name')
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute)) <code>*</code></label>
                                            <input name="{{ $attribute }}" type="text" id="{{ $attribute }}" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" required autofocus />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'company')
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>
                                            <input name="{{ $attribute }}" type="text" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="" autocomplete="off" />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'email')
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute)) <code>*</code></label>
                                            <input name="{{ $attribute }}" type="email" value="{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="" required />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'password')
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute)) <code>*</code></label>
                                            <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Please enter.')" required />
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            <span class="form-text text-muted">@lang ('Please enter characters that are hard to guess by others among 8 to 16 characters.')</span>
                                        </div>
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'password_confirmation')
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute)) <code>*</code></label>
                                            <input name="{{ $attribute }}" type="password" value class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" placeholder="@lang ('Please re-enter to confirm.')" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'leagues')
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>

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
                                            <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>

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

                                        @endif
                                </div>
                                <div class="card-footer text-center">
                                    @component ('components.buttons.back') @endcomponent

                                    <button type="submit" class="btn btn-primary">
                                        <i class="icons icon-check"></i> @lang ('Upload')
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
        (function() {
            'use strict';

            ta('.ta-leagues', 'leagues');
            ta('.ta-sports', 'sports');
            ta('.ta-universities', 'universities');
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
