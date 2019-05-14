class Uploader {
  constructor() {
    console.log("uploader")
  }

  process = () => {
    if (this.validate()) {
      this.createVideo();
    }
  };

  validate = () => {
    if (document.getElementById("video_file").files[0] === undefined) {
      return false;
    }

    return true;
  };

  createVideo = () => {
    window.Common.overlay();

    window.axios
      .post("{{ route('webapi.media.create') }}", {
        //
      })
      .then(response => {
        window.video = response.data;
        console.log(response.data);
        this.getS3Url();
      })
      .catch(error => {
        window.Common.overlayOut();
        console.log(error);
      });
  };

  getS3Url = () => {
    window.axios
      .post("/webapi/media/" + window.video.id + "/s3_url", {
        source: document.getElementById("video_file").files[0].name,
      })
      .then(response => {
        window.s3 = response.data;
        console.log(response.data);
        this.multiPartUpload();
      })
      .catch(error => {
        window.Common.overlayOut();
        console.log(error);
      });
  };

  multiPartUpload = () => {
    const s3 = new AWS.S3({
      region: "us-east-1",
      credentials: {
        sessionToken: window.s3.session_token,
        accessKeyId: window.s3.access_key_id,
        secretAccessKey: window.s3.secret_access_key,
      },
    });
    const s3Params = {
      Bucket: window.s3.bucket,
      Key: window.s3.object_key,
    };

    const file = document.getElementById("video_file").files[0];

    const allSize = file.size;
    const partSize = 1024 * 1024 * 5; // 5MB/chunk
    const multiPartParams = {
      ContentType: file.type,
      Bucket: window.s3.bucket,
      Key: window.s3.object_key,
    };

    const multipartMap = {
      Parts: [],
    };

    /*  (4)   */
    const multiPartUploadResult = /* await  */ s3.createMultipartUpload(
      multiPartParams,
      function(err, data) {
        if (err) {
          console.log(err, err.stack);
          window.Common.overlayOut();
        } else {
          const uploadId = data.UploadId;

          /*  (5)  */
          let partNum = 0;
          // const {ContentType , ...otherParams} = multiPartParams;
          var promises = [];

          for (
            let rangeStart = 0;
            rangeStart < allSize;
            rangeStart += partSize
          ) {
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

            let fileReader = new FileReader();

            fileReader.onload = event => {
              const data = event.target.result;
              let byte = new Uint8Array(data);
              // resolve(byte);
              fileReader.abort();
            };
            const blob2 = file.slice(rangeStart, end);
            fileReader.readAsArrayBuffer(blob2);
            const sendData = blob2;

            const progress = end / file.size;
            console.log(`${progress * 100}%`);

            const partParams = {
              Body: sendData,
              PartNumber: String(partNum),
              UploadId: uploadId,
              Bucket: window.s3.bucket,
              Key: window.s3.object_key,
            };
            var promise = new Promise(function(resolve) {
              s3.uploadPart(partParams, function(err, data) {
                if (err) {
                  console.log(err, err.stack);
                } else {
                  console.log(data);

                  multipartMap.Parts[partNum - 1] = {
                    ETag: data.ETag,
                    PartNumber: partNum,
                  };
                }
              }) /*.promise()*/;
            }); /* await  */
            promises.push(promise);
          }
          console.log(promises);

          Promise.all(promises)
            .then(function(value) {
              console.log(value);
              console.log(multipartMap);

              /* (6) */
              const doneParams = {
                MultipartUpload: multipartMap,
                UploadId: uploadId,
                Bucket: window.s3.bucket,
                Key: window.s3.object_key,
              };

              const completeMultipartUploadResult = /* await  */ s3.completeMultipartUpload(
                doneParams,
                function(err, data) {
                  if (err) {
                    console.log(err, err.stack);
                    window.Common.overlayOut();
                  } else {
                    console.log(data);
                    this.dynamicIngest();
                  }
                }
              );
              // .promise()
              // .then(()=> { this.dynamicIngest() })
            })
            .catch(function(error) {
              console.error(error);
            });

          // }
        }
      }
    ); /*.promise()*/
  };

  dynamicIngest = () => {
    window.axios
      .post("/webapi/media/" + window.video.id + "/ingest", {
        master_url: window.s3.api_request_url,
      })
      .then(response => {
        console.log(response.data);
        window.location.href = "/media/" + window.video.id;
      })
      .catch(error => {
        window.Common.overlayOut();
        console.log(error);
      });
  };
}

window.Uploader = new Uploader();
