class VideoCloud {
  videoId = undefined;
  uploadVideoFile = undefined;

  constructor() {}

  createObject = () => {
    window.axios
      .post("/webapi/media/create")
      .then(response => {
        console.log(response.data);
        this.videoId = response.data.id;

        if (this.uploadVideoFile !== undefined) {
          this.getS3Url();
        }
      })
      .catch(error => {
        this.suspend(error);
      });
  };

  updateObject = () => {
      //
  };

  getS3Url = () => {
    window.axios
      .post("/webapi/media/" + this.videoId + "/s3_url", {
        source: document.getElementById("video_file").files[0].name,
      })
      .then(response => {
        window.s3 = response.data;
        console.log(response.data);
        window.Uploader.multiPartUpload();
      })
      .catch(error => {
        this.suspend(error);
      });
  };

  dynamicIngest = () => {
    window.axios
      .post("/webapi/media/" + this.videoId + "/ingest", {
        master_url: window.s3.api_request_url,
      })
      .then(response => {
        console.log(response.data);
        window.location.href = "/media/" + this.videoId + "/detail";
      })
      .catch(error => {
        window.Common.overlayOut();
        console.log(error);
      });
  };

  suspend = error => {
    console.log(error, error.stack);
    window.Common.overlayOut();
  };
}

window.VideoCloud = new VideoCloud();
