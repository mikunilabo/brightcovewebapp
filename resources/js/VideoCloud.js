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
    return await window.axios
      .post("/webapi/media/create", requestData)
      .then(response => response.data)
      .catch(error => {
        if (error.response.status === 422) {
          this.invalidFeedback(error.response);
        }
        this.suspend(error);
      });
  };

  updateMedia = async requestData => {
    return await window.axios
      .post("/webapi/media/update", requestData)
      .then(response => response.data)
      .catch(error => {
        if (error.response.status === 422) {
          this.invalidFeedback(error.response);
        }
        this.suspend(error);
      });
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

  invalidFeedback = response => {
    console.log(response.data.errors);
    for (let key of Object.keys(response.data.errors)) {
      let span = document.getElementById('invalid-feedback-' + key);
      window.Common.removeChildren(span);
      let text = document.createTextNode(response.data.errors[key][0]);
      let strong = document.createElement("strong");
      strong.appendChild(text);
      span.appendChild(strong);
    }
  };

  suspend = error => {
    window.Common.overlayOut();
    alert("Mediaの作成・更新処理に失敗しました。")
    throw new Error(error);
  };
}

window.VideoCloud = new VideoCloud();
