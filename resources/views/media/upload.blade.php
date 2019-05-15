@extends ('layouts.app')

@section ('title', __('Media Upload'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Media Upload') => route('media.upload')]]) @endcomponent

        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form id="upload-form" action="{{ route('media.upload') }}" method="POST" enctype="multipart/form-data" onsubmit="return false;">
                                {{ csrf_field() }}

                                <div class="card-header">
                                    <i class="fa fa-align-justify"></i>@lang ('Media Upload')
                                </div>
                                <div class="card-body">
                                    @component ('components.messages.alerts') @endcomponent
                                    @include ('media.components.media')
                                </div>
                                <div class="card-footer text-center">
                                    @component ('components.buttons.back') @endcomponent

                                    <button type="submit" class="btn btn-primary" id="submit-btn">
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

    <script type="text/javascript" src="{{ asset('vendor/rangePlugin.js') }}"></script>
    <script type="text/javascript">
        ta('.ta-leagues', 'leagues');
        ta('.ta-sports', 'sports');
        ta('.ta-universities', 'universities');

        flatpickr('#date', {
            allowInput: true
        });

        flatpickr('#starts_at', {
            allowInput: true,
            enableTime: true,
            plugins: [new rangePlugin({ input: '#ends_at'})]
        });

        document.getElementById('submit-btn').addEventListener('click', function () {
            if (validate()) {
                window.Common.overlay();

                window.VideoCloud.uploadVideoFile = window.Uploader.uploadVideoFile = document.getElementById("video_file").files[0];
                window.VideoCloud.createObject();
            }
        });

        function validate() {
            // some validates.
            if (document.getElementById("video_file").files[0] === undefined) {
                return false;
            }
            if (document.getElementById("name").value.length === 0) {
                return false;
            }
            return true;
        }

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
