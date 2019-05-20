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
                            <form id="upload-form" autocomplete="off">
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
            plugins: [new window.flatpickr.rangePlugin({ input: '#ends_at'})]
        });

        document.getElementById('video_file').addEventListener('change', function (event) {
            let span = document.getElementById('invalid-feedback-video_file');
            window.Common.removeChildren(span);

            window.VideoCloud.source = event.target.files[0];

            let label = document.getElementById('custom-file-label');
            label.textContent = window.VideoCloud.source ? window.VideoCloud.source.name : window.lang['File not selected'];

            if (! window.VideoCloud.source || window.VideoCloud.source.size <= VALID_VIDEO_FILE_SIZE) return;

            let text = document.createTextNode(`${VALID_VIDEO_FILE_SIZE / 1024 / 1024 / 1024}GB未満のファイルを選択してください。`);
            let strong = document.createElement("strong");
            strong.appendChild(text);
            span.appendChild(strong);
        });

        document.getElementById('upload-form').addEventListener('submit', function (event) {
            event.preventDefault();

            if (! validate()) return;

            window.Common.overlay();
            const mediaObject = getMediaObject(event.target);

            window.VideoCloud.operationMediaWithSource(mediaObject, function(media) {
                window.location.href = "/media/" + media.id + "/detail";
            });
        });

        /**
         * @return bool
         */
        function validate() {
            let file = document.getElementById("video_file").files[0];
            if (! file || file.size > VALID_VIDEO_FILE_SIZE) {
                return false;
            }
            if (document.getElementById("name").value.length === 0) {
                return false;
            }
            return true;
        }

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
         * @param HTMLFormElement mediaFormElement
         * @return object mediaObject
         */
        function getMediaObject(mediaFormElement) {
            const mediaObject = {
                leagues: [],
                sports: [],
                universities: [],
            };

            [].slice.call(mediaFormElement.elements).forEach(function(input) {
                if (input.name) {
                    if (input.type === "file") {
                        return;
                    } else if (input.name.split("[").length > 1) {// If array
                        let str = input.name.split("[");
                        mediaObject[str[0]][str[1].split("]")[0]] = input.value;
                    } else {
                        mediaObject[input.name] = input.value;
                    }
                }
            });
            return mediaObject;
        }
    </script>
@endsection
