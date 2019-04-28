@extends ('layouts.app')

@section ('title', __('Account detail'))

@section ('styles')
    @parent
@endsection

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Account detail') => route('accounts.detail', $row->id)]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form action="{{ route('accounts.detail', $row->id) }}" method="POST">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Account detail')
                                </div>
                                <div class="card-body">
                                    <div class="card-body">
                                        @component ('components.messages.alerts') @endcomponent

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                @component ('components.videos.players.videocloud', ['videoId' => $row->id, 'accountId' => config('services.videocloud.account_id')]) @endcomponent
                                            </div>
                                            <div class="form-group col-md-6">
                                                @set ($attribute, 'id')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>
                                                <div><code>{{ $row->{$attribute} }}</code></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                @set ($attribute, 'state')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>
                                                @component ('components.labels.videos.state', ['state' => $row->{$attribute}]) @endcomponent
                                            </div>
                                            <div class="form-group col-md-6">
                                                @set ($attribute, 'ingestjobs')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>
                                                @component ('components.labels.videos.ingest_jobs', ['items' => $ingestjobs]) @endcomponent
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                @set ($attribute, 'name')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute)) <code>*</code></label>
                                                <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off" required autofocus>
                                                    {{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}
                                                </textarea>
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                @set ($attribute, 'description')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>
                                                <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="3" placeholder="" autocomplete="off">
                                                    {{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}
                                                </textarea>
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                @set ($attribute, 'long_description')
                                                <label for="{{ $attribute }}">@lang (sprintf('attributes.media.%s', $attribute))</label>
                                                <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="3" placeholder="" autocomplete="off">
                                                    {{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : $row->{$attribute} }}
                                                </textarea>
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>

                                        @foreach (['leagues', 'universities', 'sports'] as $attribute)
                                            @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : $row->tags ?? []])
                                            <hr>
                                        @endforeach

                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                @set ($attribute, 'created_at')
                                                <label for="{{ $attribute }}">@lang ('Created At')</label>
                                                <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone('Asia/Tokyo') }}</div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                @set ($attribute, 'updated_at')
                                                <label for="{{ $attribute }}">@lang ('Updated At')</label>
                                                <div>{{ is_null($row->{$attribute}) ? null : now()->parse($row->{$attribute})->setTimezone('Asia/Tokyo') }}</div>
                                            </div>
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
                                        <a class="btn btn-danger btn-sm float-right" href="{{ route('accounts.delete', $row->id) }}" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to delete this :name?', ['name' => __('Account')])')) { window.Common.submitForm('{{ route('accounts.delete', $row->id) }}'); } return false;">
                                            <i class="icons icon-trash"></i> @lang ('Delete account')
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
