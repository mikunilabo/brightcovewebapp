class VideoCloud {
  mediaId = null;
  source = null;

  constructor() {}

  operationMediaWithSource = async (mediaObject, callback) => {
    let media;
    if (this.mediaId) {
      media = await this.updateMedia(mediaObject);
    } else {
      media = await this.createMedia(mediaObject);
      this.mediaId = media.id;
    }

    if (this.source) {
      const s3Url = await this.getS3Url(this.mediaId, this.source.name);
      await window.Uploader.multiPartUpload(this.source, s3Url);
      await this.dynamicIngest(this.mediaId, s3Url.api_request_url);
    }

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
      .post("/webapi/media/" + this.mediaId + "/update", requestData)
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
    console.error(response.data.errors);

    [].slice.call(document.getElementsByClassName('invalid-feedback')).forEach(function(span) {
      window.Common.removeChildren(span);
    });

    for (let key of Object.keys(response.data.errors)) {
      let span = document.getElementById('invalid-feedback-' + key);

      if (! span) continue;

      let text = document.createTextNode(response.data.errors[key][0]);
      let strong = document.createElement("strong");
      strong.appendChild(text);
      span.appendChild(strong);
    }
  };

  suspend = error => {
    window.Common.progressOverlayOut();
    alert("Mediaの作成・更新処理に失敗しました。")
    throw new Error(error);
  };
}

window.VideoCloud = new VideoCloud();
