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
        (function() {
            'use strict';

            document.getElementById('submit-btn').addEventListener('click', function () {
                process();
            });

            flatpickr('#date', {
                allowInput: true
            });

            flatpickr('#starts_at', {
                allowInput: true,
                enableTime: true,
                plugins: [new rangePlugin({ input: '#ends_at'})]
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

            window.axios.post("{{ route('webapi.media.create') }}", {
              //
            }).then(response => {
                window.video = response.data;
                console.log(response.data);
                getS3Url();
            }).catch(error => {
                window.Common.overlayOut();
                console.log(error);
            });
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


  //
  // Evaporate.create({
  //   /* START EDITS */
  //   aws_key: window.s3.access_key_id, // REQUIRED -- set this to your AWS_ACCESS_KEY_ID
  //   bucket: window.s3.bucket, // REQUIRED -- set this to your s3 bucket name
  //   awsRegion: 'us-east-1', // OPTIONAL -- change this if your bucket is outside us-east-1
  //   /* END EDITS */
  //   signerUrl: window.s3.signed_url,
  //   awsSignatureVersion: '4',
  //   computeContentMd5: true,
  //   cryptoMd5Method: function (data) { return AWS.util.crypto.md5(data, 'base64'); },
  //   cryptoHexEncodedHash256: function (data) { return AWS.util.crypto.sha256(data, 'hex'); }
  // })
  // .then(
  //   // Successfully created evaporate instance `_e_`
  //   function success(_e_) {
  //     var fileInput = document.getElementById('video_file'),
  //         filePromises = [];
  //     // Start a new evaporate upload anytime new files are added in the file input
  //     // fileInput.onchange = function(evt) {
  //       var files = document.getElementById('video_file').files;
  //       for (var i = 0; i < files.length; i++) {
  //         var promise = _e_.add({
  //           name: 'test_' + Math.floor(1000000000*Math.random()),
  //           file: files[i],
  //           progress: function (progress) {
  //             console.log('making progress: ' + progress);
  //           }
  //         })
  //         .then(function (awsKey) {
  //           console.log(awsKey, 'complete!');
  //         });
  //         filePromises.push(promise);
  //       }
  //       // Wait until all promises are complete
  //       Promise.all(filePromises)
  //         .then(function () {
  //           console.log('All files were uploaded successfully.');
  //           dynamicIngest();
  //         }, function (reason) {
  //           console.log('All files were not uploaded successfully:', reason);
  //           window.Common.overlayOut();
  //         });
  //       // Clear out the file picker input
  //       evt.target.value = '';
  //     // };
  //   },
  //   // Failed to create new instance of evaporate
  //   function failure(reason) {
  //      console.log('Evaporate failed to initialize: ', reason)
  //   }
  // );

// Single part upload
// s3.putObject(
//   {
//     Bucket: window.s3.bucket,
//     Key: window.s3.object_key,
//     Body: file
//   },
//   function(err, data) {
//     if (err) {
//       console.log(err, err.stack);
//     }
//     else {
//       console.log(data);
//       dynamicIngest();
//     }
//   }
// );

            // const upload = async (s3, s3Params, file)=>{

                const allSize = file.size
                const partSize = 1024 * 1024 * 5; // 5MB/chunk
                const multiPartParams = {
                  ContentType :file.type,
                  Bucket: window.s3.bucket,
                  Key: window.s3.object_key
                };

                const multipartMap = {
                    Parts: []
                };

                /*  (4)   */
                const multiPartUploadResult = /* await  */s3.createMultipartUpload(multiPartParams, function(err, data) {
                  if (err) {
                    console.log(err, err.stack);
                    window.Common.overlayOut();
                  }
                  else {
                    const uploadId = data.UploadId;

                    /*  (5)  */
                    let partNum = 0;
                    // const {ContentType , ...otherParams} = multiPartParams;
                    var promises = [];

                    for (let rangeStart = 0; rangeStart < allSize; rangeStart += partSize) {
                        partNum++;
                        const end = Math.min(rangeStart + partSize, allSize);

                        // const sendData = /* await  */new Promise((resolve)=>{
                        //     let fileReader =  new FileReader();
                        //
                        //     fileReader.onload = (event)=>{
                        //         const data = event.target.result;
                        //         let byte = new Uint8Array(data);
                        //         resolve(byte);
                        //         fileReader.abort();
                        //     };
                        //     const blob2 = file.slice(rangeStart , end);
                        //     fileReader.readAsArrayBuffer(blob2);
                        // });

                        let fileReader =  new FileReader();

                        fileReader.onload = (event)=>{
                            const data = event.target.result;
                            let byte = new Uint8Array(data);
                            // resolve(byte);
                            fileReader.abort();
                        };
                        const blob2 = file.slice(rangeStart , end);
                        fileReader.readAsArrayBuffer(blob2);
                        const sendData = blob2;

                        const progress = end / file.size;
                        console.log(`${progress * 100}%`);

                        const partParams = {
                            Body: sendData,
                            PartNumber: String(partNum),
                            UploadId: uploadId,
                            Bucket: window.s3.bucket,
                            Key: window.s3.object_key
                        };
                        var promise = new Promise(function (resolve) {
                          s3.uploadPart(partParams, function(err, data) {
                            if (err) {
                              console.log(err, err.stack);
                            }
                            else {
                              console.log(data);

                              multipartMap.Parts[partNum - 1] = {
                                  ETag: data.ETag,
                                  PartNumber: partNum
                              };
                            }
                          })/*.promise()*/;
                        })/* await  */;
                        promises.push(promise);
                    }
                    console.log(promises);

                    Promise.all(promises).then(function (value) {
                        console.log(value);
                        console.log(multipartMap);

                        /* (6) */
                        const doneParams = {
                            MultipartUpload: multipartMap,
                            UploadId: uploadId,
                            Bucket: window.s3.bucket,
                            Key: window.s3.object_key
                        };

                        const completeMultipartUploadResult = /* await  */s3.completeMultipartUpload(doneParams, function(err, data) {
                          if (err) {
                            console.log(err, err.stack);
                            window.Common.overlayOut();
                          }
                          else {
                            console.log(data);
                            dynamicIngest();
                          }
                        });
                        // .promise()
                        // .then(()=> { dynamicIngest() })
                    }).catch(function(error) {
                        console.error(error);
                    });

                // }
                  }
                })/*.promise()*/;

        }

        function dynamicIngest() {
            window.axios.post('/webapi/media/' + window.video.id + '/ingest', {
                master_url: window.s3.api_request_url
            }).then(response => {
                console.log(response.data);
                window.location.href = '/media/' + window.video.id + '/detail';
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
