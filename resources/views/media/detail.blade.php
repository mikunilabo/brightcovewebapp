@extends ('layouts.app')

@section ('title', __('Media detail'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Media detail') => route('accounts.detail', $row->id)]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('media.detail', $row->id) }}" method="POST" onsubmit="window.Common.overlay();">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Media detail')
                                </div>
                                <div class="card-body">
                                    @component ('components.messages.alerts') @endcomponent

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @component ('components.videos.players.videocloud', ['videoId' => $row->id, 'accountId' => config('services.videocloud.account_id')]) @endcomponent
                                        </div>
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'id')
                                            <label for="{{ $attribute }}">@lang ('ID')</label>
                                            <div><code>{{ $row->{$attribute} }}</code></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'state')
                                            <label for="{{ $attribute }}">@lang ('Status')</label>
                                            @component ('components.labels.videos.state', ['state' => $row->{$attribute}]) @endcomponent
                                        </div>
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'ingestjobs')
                                            <label for="{{ $attribute }}">@lang ('Ingest Status')</label>
                                            @component ('components.labels.videos.ingest_jobs', ['items' => $ingestjobs]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'name')
                                            <label for="{{ $attribute }}">@lang ('Title') <code>*</code></label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off" required>{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'description')
                                            <label for="{{ $attribute }}">@lang ('Description')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="5" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'long_description')
                                            <label for="{{ $attribute }}">@lang ('Keywords')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="3" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'rightholder')
                                            <label for="{{ $attribute }}">@lang ('Rightholder')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'tournament')
                                            <label for="{{ $attribute }}">@lang ('Tournament')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>

                                    @foreach (['leagues' => $vc_leagues, 'universities' => $vc_universities, 'sports' => $vc_sports] as $attribute => $items)
                                        @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : collect($row->tags)->filter(function ($value) use ($items) { return $items->containsStrict('name', $value); })])
                                        <hr>
                                    @endforeach

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'created_at')
                                            <label for="{{ $attribute }}">@lang ('Created At')</label>
                                            <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone')) }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'updated_at')
                                            <label for="{{ $attribute }}">@lang ('Updated At')</label>
                                            <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone(config('app.timezone')) }}</div>
                                        </div>
                                        </div>
                                </div>
                                <div class="card-footer text-center">
                                    @component ('components.buttons.back') @endcomponent

                                    @can ('update', $row)
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icons icon-check"></i> @lang ('Update')
                                        </button>
                                    @endcan

                                    @can ('delete', $row)
                                        <a class="btn btn-danger btn-sm float-right" href="{{ route('media.delete', $row->id) }}" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to delete this :name?', ['name' => __('Media')])')) { window.Common.submitForm('{{ route('media.delete', $row->id) }}'); } return false;">
                                            <i class="icons icon-trash"></i> @lang ('Delete media')
                                        </a>
                                    @endcan
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
