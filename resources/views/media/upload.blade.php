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

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            @set ($attribute, 'video_file')
                                            <label for="{{ $attribute }}">@lang ('Video File') <code>*</code></label>

                                            @component ('components.popovers.informations', ['content' => '20MB']) @endcomponent

                                            <div>
                                                <input type="file" id="{{ $attribute }}" class="{{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" required />
                                                @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                            </div>
                                        </div>
                                    </div>

                                    @if (false)
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'name')
                                            <label for="{{ $attribute }}">@lang ('Title') <code>*</code></label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off" required>{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'description')
                                            <label for="{{ $attribute }}">@lang ('Description')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="4" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'long_description')
                                            <label for="{{ $attribute }}">@lang ('Keywords')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="3" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'rightholder')
                                            <label for="{{ $attribute }}">@lang ('Rightholder')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            @set ($attribute, 'tournament')
                                            <label for="{{ $attribute }}">@lang ('Tournament')</label>
                                            <textarea name="{{ $attribute }}" id="{{ $attribute }}" class="form-control {{ $errors->{$errorBag ?? 'default'}->has($attribute) ? 'is-invalid' : '' }}" rows="1" placeholder="" autocomplete="off">{{ $errors->{$errorBag ?? 'default'}->any() ? old($attribute) : null }}</textarea>
                                            @component ('components.messages.invalid', ['name' => $attribute]) @endcomponent
                                        </div>
                                    </div>

                                    @foreach (['leagues' => Auth::user()->leagues, 'universities' => Auth::user()->universities, 'sports' => Auth::user()->sports] as $attribute => $items)
                                        @include ('components.typeahead.lists', ['attribute' => $attribute, 'items' => $errors->{$errorBag ?? 'default'}->any() ? old($attribute, []) : $items->pluck('name')->all()])
                                        <hr>
                                    @endforeach
                                    @endif
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
        (function() {
            'use strict';

            document.getElementById('submit-btn').addEventListener('click', function () {
                process();
            });

//             ta('.ta-leagues', 'leagues');
//             ta('.ta-sports', 'sports');
//             ta('.ta-universities', 'universities');
        })();

        function process() {
            if (validate()) {
                createVideo();
            }
        }

        function validate() {
            if (document.getElementById('video_file').files[0] === undefined) {
                return false;
            }

          return true;
        }

        function createVideo() {
            window.Common.overlay();

//             window.axios.post("{{ route('webapi.media.create') }}", {
//               //
//             }).then(response => {
//                 window.video = response.data;
                window.video = {id: '6034553343001'};// TODO XXX
//                 console.log(response.data);
                getS3Url();
//             }).catch(error => {
//                 window.Common.overlayOut();
//                 console.log(error);
//             });
        }

        function getS3Url() {
            window.axios.post('/webapi/media/' + window.video.id + '/s3_url', {
                source: document.getElementById('video_file').files[0].name
            }).then(response => {
                window.s3 = response.data;
                console.log(response.data);
                multiPartUpload();
            }).catch(error => {
                window.Common.overlayOut();
                console.log(error);
            });
        }

        function multiPartUpload() {
            const s3 = new AWS.S3({
              region: 'us-east-1',
              credentials: {
                sessionToken: window.s3.session_token,
                accessKeyId: window.s3.access_key_id,
                secretAccessKey: window.s3.secret_access_key
              }
            })
            const s3Params = {
              Bucket: window.s3.bucket,
              Key: window.s3.object_key
            }

            const file = document.getElementById('video_file').files[0];

            const upload = async (s3, s3Params, file)=>{

                const mime = Mime.getSize(file.name);
                const multiPartParams = s3Params.ContentType ? s3Params : {ContentType : mime , ...s3Params};
                const allSize = file.size

                const partSize = 1024 * 1024 * 5; // 5MB/chunk

                const multipartMap = {
                    Parts: []
                };

                /*  (4)   */
                const multiPartUploadResult = await s3.createMultipartUpload(multiPartParams).promise();
                const uploadId = multiPartUploadResult.UploadId;

                /*  (5)  */
                let partNum = 0;
                const {ContentType , ...otherParams} = multiPartParams;
                for (let rangeStart = 0; rangeStart < allSize; rangeStart += partSize) {
                    partNum++;
                    const end = Math.min(rangeStart + partSize, allSize);

                    const sendData = await new Promise((resolve)=>{
                        let fileReader =  new FileReader();

                        fileReader.onload = (event)=>{
                            const data = event.target.result;
                            let byte = new Uint8Array(data);
                            resolve(byte);
                            fileReader.abort();
                        };
                        const blob2 = this.file.slice(rangeStart , end);
                        fileReader.readAsArrayBuffer(blob2);
                    })

                    const progress = end / file.size;
                    console.log(`今,${progress * 100}%だよ`);

                    const partParams = {
                        Body: sendData,
                        PartNumber: String(partNum),
                        UploadId: uploadId,
                        ...otherParams,
                    };
                    const partUpload = await s3.uploadPart(partParams).promise();

                    multipartMap.Parts[partNum - 1] = {
                        ETag: partUpload.ETag,
                        PartNumber: partNum
                    };
                }

                /* (6) */
                const doneParams = {
                    ...otherParams,
                    MultipartUpload: multipartMap,
                    UploadId: uploadId
                };

                await s3.completeMultipartUpload(doneParams)
                    .promise()
                    .then(()=> dynamicIngest())
            }
        }

        function dynamicIngest() {
            window.axios.post('/webapi/media/' + window.video.id + '/ingest', {
                master_url: window.s3.api_request_url
            }).then(response => {
                // complete
                console.log(response.data);
                // redirect to detail page.
            }).catch(error => {
                window.Common.overlayOut();
                console.log(error);
            });
        }

        /**
         * @param string id
         * @return void
         */
//         function ta(tag, name) {
//             if (name === 'leagues') {
//                 var json = @json ($vc_leagues->pluck('name'));
//             } else if (name === 'sports') {
//                 var json = @json ($vc_sports->pluck('name'));
//             } else if (name === 'universities') {
//                 var json = @json ($vc_universities->pluck('name'));
//             }

//             $(tag).typeahead({
//                 highlight: true,
//                 hint: false,
//                 minLength: 0
//             },
//             {
//                 name: 'states',
//                 limit: 100,
//                 source: window.Common.substringMatcher(json)
//             });
//         }
    </script>
@endsection
