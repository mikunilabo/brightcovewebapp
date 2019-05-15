class VideoCloud {
  constructor() {}

  createMediaWithSource = async (mediaObject, callback) => {
    const media = await this.createMedia(mediaObject);
    console.log("%cMedia Created", "background: #F90; color: #FFF", media);

    const s3Url = await this.getS3Url(media.id, mediaObject.video_file.name);
    console.log("%cS3 URL Fetched", "background: #990; color: #FFF", s3Url);

    const uploadResponse = await window.Uploader.multiPartUpload(
      mediaObject.video_file,
      s3Url,
    );
    console.log("%cFile Uploaded", "background: #99F; color: #FFF", uploadResponse);

    const ingestResponse = await this.dynamicIngest(media.id, s3Url.api_request_url);
    console.log("%cIngest Started", "background: #F0F; color: #FFF", ingestResponse);

    callback(media);
  };

  createMedia = async requestData => {
    try {
      return await window.axios
        .post("/webapi/media/create", requestData)
        .then(response => response.data);
    } catch (error) {
      this.suspend(error);
    }
  };

  updateMedia = async requestData => {
    try {
      return await window.axios
        .post("/webapi/media/update", requestData)
        .then(response => response.data);
    } catch (error) {
      this.suspend(error);
    }
  };

  getS3Url = async (videoId, name) => {
    try {
      return await window.axios
        .post("/webapi/media/" + videoId + "/s3_url", {
          source: name,
        })
        .then(response => response.data);
    } catch (error) {
      this.suspend(error);
    }
  };

  dynamicIngest = (videoId, s3apiRequestUrl) => {
    try {
      return window.axios
        .post("/webapi/media/" + videoId + "/ingest", {
          master_url: s3apiRequestUrl,
        })
        .then(response => response.data);
    } catch (error) {
      this.suspend(error);
    }
  };

  suspend = error => {
    window.Common.overlayOut();
    alert("Mediaの作成・更新処理に失敗しました。")
    throw new Error(error);
  };
}

window.VideoCloud = new VideoCloud();
