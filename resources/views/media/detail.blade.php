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
                            <form action="{{ route('media.detail', $row->id) }}" method="POST" onsubmit="return false;">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Media detail')
                                </div>
                                <div class="card-body">
                                    @component ('components.messages.alerts') @endcomponent
                                    @include ('media.components.media')
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

    <script type="text/javascript" src="{{ asset('vendor/rangePlugin.js') }}"></script>
    <script type="text/javascript">
        (function() {
            'use strict';

            ingestjobs();

            flatpickr('#date', {
                allowInput: true
            });

            flatpickr('#starts_at', {
                allowInput: true,
                enableTime: true,
                plugins: [new rangePlugin({ input: '#ends_at'})]
            });

            ta('.ta-leagues', 'leagues');
            ta('.ta-sports', 'sports');
            ta('.ta-universities', 'universities');
        })();

        /**
         * @param string tag
         * @param string name
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

        /**
         * @return void
         */
        function ingestjobs() {
            window.Common.overlay();
            window.axios.get("{{ route('webapi.media.ingestjobs', $row->id) }}")
                .then(response => {
                    window.Common.overlayOut();
                    for (let key of Object.keys(response.data)) {
                        var state = response.data[key].state;
                        var span = document.getElementById('ingestjobs_result');
                        span.classList.remove('badge-light', 'badge-dark', 'badge-primary', 'badge-secondary', 'badge-danger', 'badge-warning', 'badge-success', 'badge-info');
                        span.classList.add('badge-' + window.Common.labelNameForIngestJob(state));
                        span.textContent = window.lang[state];
                        break;
                    }
                }).catch(error => {
                    window.Common.overlayOut();
                    console.log(error);
                });
        }
    </script>
@endsection
