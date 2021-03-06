@extends ('layouts.app')

@section ('title', __('Media detail'))

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb', ['lists' => [__('Media detail') => route('accounts.detail', $row->id)]]) @endcomponent

        <div class="container-fluid animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <form id="upload-form" autocomplete="off">
                            {{ csrf_field() }}

                            <div class="card-header">
                                <i class="icons icon-note"></i>@lang ('Media detail')
                            </div>
                            <div class="card-body">
                                @component ('components.messages.alerts') @endcomponent
                                @include ('media.components.media')
                            </div>
                            <div class="card-footer text-center">
                                @component ('components.buttons.back') @endcomponent

                                @can ('update', $row)
                                    <button type="submit" class="btn btn-outline-primary">
                                        <i class="icons icon-check"></i> @lang ('Update')
                                    </button>
                                @endcan

                                @can ('delete', $row)
                                    <a class="btn btn-outline-danger btn-sm float-right" href="#" onclick="event.preventDefault(); if (confirm('@lang ('Are you sure you want to delete this :name?', ['name' => __('Media')])')) { window.Common.submitForm('{{ route('media.delete', $row->id) }}'); } return false;">
                                        <i class="icons icon-trash"></i> @lang ('Delete media')
                                    </a>
                                @endcan
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section ('scripts')
    @parent

    <script type="text/javascript">
      ingestjobs();

      ta('.ta-leagues', 'leagues');
      ta('.ta-sports', 'sports');
      ta('.ta-universities', 'universities');

      flatpickr('#date', {
        allowInput: true,
        dateFormat: "Y/m/d",
        disableMobile: true,
      });

      flatpickr('#starts_at', {
        allowInput: true,
        dateFormat: "Y/m/d H:i",
        disableMobile: true,
        enableTime: true,
        // plugins: [new window.flatpickr.rangePlugin({ input: '#ends_at'})]
      });

      flatpickr('#ends_at', {
        allowInput: true,
        dateFormat: "Y/m/d H:i",
        disableMobile: true,
        enableTime: true,
      });

      document.getElementById('video_file').addEventListener('change', function (event) {
        let span = document.getElementById('invalid-feedback-video_file');
        window.Common.removeChildren(span);

        window.VideoCloud.source = event.target.files[0];

        let label = document.getElementById('custom-file-label');
        label.textContent = window.VideoCloud.source ? window.VideoCloud.source.name : window.Common.trance('File not selected');

        if (! window.VideoCloud.source || window.VideoCloud.source.size <= VALID_VIDEO_FILE_SIZE) return;

        let text = document.createTextNode(`${VALID_VIDEO_FILE_SIZE / 1024 / 1024 / 1024}GB未満のファイルを選択してください。`);
        let strong = document.createElement("strong");
        strong.appendChild(text);
        span.appendChild(strong);
      });

      document.getElementById('upload-form').addEventListener('submit', function (event) {
        event.preventDefault();

        if (! validate()) return;

        window.VideoCloud.source ? window.Common.progressOverlay() : window.Common.overlay();
        const mediaObject = getMediaObject(event.target);

        window.VideoCloud.mediaId = {{ $row->id }};
        window.VideoCloud.operationMediaWithSource(mediaObject, function(media) {
          window.location.reload();
        });
      });

      /**
       * @return bool
       */
      function validate() {
        let file = document.getElementById("video_file").files[0];
        if (file && file.size > VALID_VIDEO_FILE_SIZE) {
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
        var data = getMasters(name);

        $(tag).typeahead({
          highlight: true,
          hint: false,
          minLength: 0
        },
        {
          name: 'states',
          limit: 100,
          source: window.Common.substringMatcher(data)
        })
        .on('typeahead:selected', function (event, datum) {
          // Fire the same input event as normal input.
          event.target.dispatchEvent(new Event('input'));
        });
      }

      /**
       * @param string name
       * @return json
       * @throw Error
       */
      function getMasters(name) {
        switch (true) {
          case name === 'leagues':
            return @json ($vc_leagues->pluck('name'));
          case name === 'sports':
            return @json ($vc_sports->pluck('name'));
          case name === 'universities':
            return @json ($vc_universities->pluck('name'));
          default:
            throw new Error(`The master name [${name}] is invalid.`);
        }
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
              span.textContent = window.Common.trance(state);
              break;
            }
          }).catch(error => {
            window.Common.overlayOut();
            console.error(error);
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
            } else if (input.name === 'state' && input.checked === false) {
              return;
            } else {
              mediaObject[input.name] = input.value;
            }
          }
        });
        return mediaObject;
      }
    </script>
@endsection
