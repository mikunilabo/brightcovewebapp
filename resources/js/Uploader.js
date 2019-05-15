import AWS from "aws-sdk";

class Uploader {
  uploadVideoFile = undefined;

  constructor() {}

  multiPartUpload = async () => {
    const s3 = new AWS.S3({
      region: "us-east-1",
      credentials: {
        sessionToken: window.s3.session_token,
        accessKeyId: window.s3.access_key_id,
        secretAccessKey: window.s3.secret_access_key,
      },
    });
    const file = this.uploadVideoFile;
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
        const blob2 = file.slice(rangeStart, end);
        fileReader.readAsArrayBuffer(blob2);
      });

      const progress = end / file.size;
      console.log(`${progress * 100}%`);

      const partUpload = await s3.uploadPart({
        Body: sendData,
        PartNumber: String(partNum),
        UploadId: uploadId,
        Bucket: multiPartParams.Bucket,
        Key: multiPartParams.Key,
      }).promise();

      multipartMap.Parts[partNum - 1] = {
        ETag: partUpload.ETag,
        PartNumber: partNum,
      };
    }

    await s3
      .completeMultipartUpload({
        Bucket: multiPartParams.Bucket,
        Key: multiPartParams.Key,
        MultipartUpload: multipartMap,
        UploadId: uploadId,
      })
      .promise()
      .then(() => window.VideoCloud.dynamicIngest());
  };

  suspend = error => {
    console.log(error, error.stack);
    window.Common.overlayOut();
  };
}

window.Uploader = new Uploader();
