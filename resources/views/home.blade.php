@extends ('layouts.app')

@section ('title', __('Dashboard'))

@section ('styles')
    @parent

    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet" type="text/css">
@endsection

@section ('content')
    <main class="main">
        @component ('layouts.breadcrumb') @endcomponent

        <div class="container-fluid animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    @if (false)
                    <button type="button" id="toastr" class="btn btn-info">toastr</button>

                    @component ('components.popovers.informations', ['content' => __('Click to copy to clipboard.')]) @endcomponent
                    <input type="text" id="input" class="form-control" value="testtest" readonly />

                    <textarea id="result" class="form-control" disabled></textarea>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection

@section ('scripts')
    @parent

    <script type="text/javascript">
      (function () {
        'use strict';

        notifications();

        // var input = document.getElementById('input');
        // input.addEventListener('click' , function(e){
        //   input.select();
        //   document.execCommand('copy');
        //   window.toastr.info(window.lang['Copied it to the clipboard.']);
        // });
      })();

      function notifications() {
        let list = document.getElementById('notifications-list');
        window.Common.removeChildren(list);
        console.log(list);

        window.axios.get("{{ route('webapi.notifications.index') }}")
            .then(response => {
              if (Object.keys(response.data).length > 0) {
                let badge = document.getElementById('notifications-badge');
                badge.textContent = Object.keys(response.data).length;

                for (let key of Object.keys(response.data)) {
                  let div = document.createElement("div");
                  div.classList.add("dropdown-header", "text-center");
                  div.type = "button";

                    // var state = response.data[key].state;
                    // var span = document.getElementById('ingestjobs_result');
                    // span.classList.remove('badge-light', 'badge-dark', 'badge-primary', 'badge-secondary', 'badge-danger', 'badge-warning', 'badge-success', 'badge-info');
                    // span.classList.add('badge-' + window.Common.labelNameForIngestJob(state));
                    // span.textContent = window.lang[state];
                }

              } else {
                //
              }
            }).catch(error => {
                console.error(error);
            });
      }

      // document.getElementById('toastr').addEventListener('click', function (event) {
      //   window.toastr.info('My name is Inigo Montoya. You killed my father, prepare to die!');
      //   window.toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');
      //   window.toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');
      //   window.toastr.success('Have fun storming the castle!', 'Miracle Max Says', {
      //     "closeButton": true,
      //     "debug": false,
      //     "newestOnTop": false,
      //     "progressBar": false,
      //     "positionClass": "toast-bottom-right",
      //     "preventDuplicates": false,
      //     "showDuration": "300",
      //     "hideDuration": "1000",
      //     "timeOut": "5000",
      //     "extendedTimeOut": "1000",
      //     "showEasing": "swing",
      //     "hideEasing": "linear",
      //     "showMethod": "fadeIn",
      //     "hideMethod": "fadeOut"
      //   });

        // Immediately remove current toasts without using animation
        // window.toastr.remove()

        // Remove current toasts using animation
        // window.toastr.clear()
      // });
    </script>
@endsection
