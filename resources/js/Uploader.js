import AWS from "aws-sdk";

class Uploader {
  constructor() {}

  multiPartUpload = async (uploadFile, s3Url) => {
    const s3 = new AWS.S3({
      region: "us-east-1",
      credentials: {
        sessionToken: s3Url.session_token,
        accessKeyId: s3Url.access_key_id,
        secretAccessKey: s3Url.secret_access_key,
      },
    });
    const allSize = uploadFile.size;
    const partSize = 1024 * 1024 * 5; // 5MB/chunk
    const multiPartParams = {
      ContentType: uploadFile.type,
      Bucket: s3Url.bucket,
      Key: s3Url.object_key,
    };

    const multipartMap = {
      Parts: [],
    };

    const multiPartUploadResult = await s3
      .createMultipartUpload(multiPartParams)
      .promise();
    const uploadId = multiPartUploadResult.UploadId;
    let partNum = 0;
    for (let rangeStart = 0; rangeStart < allSize; rangeStart += partSize) {
      partNum++;
      const end = Math.min(rangeStart + partSize, allSize);

      const sendData = await new Promise(resolve => {
        let fileReader = new FileReader();

        fileReader.onload = event => {
          const data = event.target.result;
          let byte = new Uint8Array(data);
          resolve(byte);
          fileReader.abort();
        };
        const blob2 = uploadFile.slice(rangeStart, end);
        fileReader.readAsArrayBuffer(blob2);
      });

      console.log("%cProgress",  "background: #32F; color: #FFF", `${progress * 100}%`);
      const progress = end / uploadFile.size * 100;
      if ($("#progressOverlay").is(":visible")) {
        window.Common.updateProgressOverlay(Math.round(progress));
      }

      const partUpload = await s3
        .uploadPart({
          Body: sendData,
          PartNumber: String(partNum),
          UploadId: uploadId,
          Bucket: multiPartParams.Bucket,
          Key: multiPartParams.Key,
        })
        .promise();

      multipartMap.Parts[partNum - 1] = {
        ETag: partUpload.ETag,
        PartNumber: partNum,
      };
    }

    return await s3
      .completeMultipartUpload({
        Bucket: multiPartParams.Bucket,
        Key: multiPartParams.Key,
        MultipartUpload: multipartMap,
        UploadId: uploadId,
      })
      .promise()
      .then(res => res);
  };

  suspend = error => {
    console.error(error, error.stack);
    alert("アップロード処理に失敗しました。");
    window.Common.progressOverlayOut();
  };
}

window.Uploader = new Uploader();
