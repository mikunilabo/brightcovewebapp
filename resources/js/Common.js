class Common {
  constructor() {}

  /**
   * @param string url
   * @param string method
   * @return void
   */
  submitForm(url, method = "post") {
    var form = document.getElementById("basic-form");
    form.action = url;
    form.method = method;
    form.submit();
    this.overlay();
  }

  /**
   * @param array strings
   * @return array
   */
  substringMatcher(strings) {
    return function findMatches(q, cb) {
      var matches, substrRegex;

      // an array that will be populated with substring matches
      matches = [];

      // regex used to determine if a string contains the substring `q`
      substrRegex = new RegExp(q, "i");

      // iterate through the pool of strings and for any string that
      // contains the substring `q`, add it to the `matches` array
      $.each(strings, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });

      cb(matches);
    };
  }

  /**
   * @param string name
   */
  createTypeAheadList(name) {
    var cnt = document.getElementById(name + "-list-cnt");
    var listId = name + "-list-" + cnt.value;

    var i = document.createElement("i");
    i.classList.add("icons", "icon-close");

    var button = document.createElement("button");
    button.classList.add("btn", "btn-outline-danger", "input-group-text");
    button.type = "button";
    button.addEventListener(
      "click",
      () => {
        this.removeElement(listId);
      },
      false,
    );
    button.appendChild(i);

    var div = document.createElement("div");
    div.classList.add("input-group-append");
    div.appendChild(button);

    var input = document.createElement("input");
    var inputId = "ta-" + name + "-" + cnt.value;
    input.id = inputId;
    input.classList.add("form-control", "typeahead");
    input.name = name + "[" + cnt.value + "]";
    input.type = "text";
    input.value = "";
    input.maxLength = 255;
    input.autocomplete = "off";

    var inputGroup = document.createElement("div");
    inputGroup.classList.add("input-group");
    inputGroup.appendChild(input);
    inputGroup.appendChild(div);

    var span = document.createElement("span");
    span.classList.add("invalid-feedback", "d-block");
    span.id = "invalid-feedback-" + name + "." + cnt.value;
    span.role = "alert";
    var strong = document.createElement("strong");
    span.appendChild(strong);

    var child = document.createElement("div");
    child.id = listId;
    child.classList.add("form-group", "col-md-6");
    child.appendChild(inputGroup);
    child.appendChild(span);

    var parent = document.getElementById(name + "-area");
    var target = document.getElementById(name + "-add-btn-area");
    parent.insertBefore(child, target);

    ta("#" + inputId, name);
    cnt.value++;
  }

  /**
   * @param string id
   * @return void
   */
  removeElement(id) {
    var element = document.getElementById(id);
    element.parentNode.removeChild(element);
  }

  /**
   * @param string job
   * @return string
   */
  labelNameForIngestJob(job) {
    switch (job) {
      case "published": // Non break
      case "publishing": // Non break
      case "finished":
        return "success";

      case "processing":
        return "warning";

      case "failed":
        return "danger";

      default:
        return "light";
    }
  }

  /**
   * @return void
   */
  overlay() {
    $("#overlay").fadeIn(500);
  }

  /**
   * @return void
   */
  overlayOut() {
    $("#overlay").fadeOut(500);
  }

  /**
   * @param number initialProgress
   * @return void
   */
  progressOverlay(initialProgress = 0) {
    this.updateProgressOverlay(initialProgress);
    $("#progressOverlay").fadeIn(500);
  }

  /**
   * @return void
   */
  progressOverlayOut() {
    $("#progressOverlay").fadeOut(500, () => {
      this.updateProgressOverlay(0);
    });
  }

  /**
   * @param number progress
   * @return void
   */
  updateProgressOverlay(progress) {
    $("#progressOverlay")
      .find(".progress-bar")
      .attr({
        ariaValuenow: progress,
      })
      .css({
        width: `${progress}%`,
      })
      .text(`${progress}%`);
  }

  /**
   * @param string name
   * @return void
   */
  listMasters(name) {
    let body = document.getElementById(name + "-modal-body");
    this.removeChildren(body);

    window.axios
      .get("/webapi/" + name)
      .then((response) => {
        this.overlayOut();
        body.innerHtml = "";

        for (let key of Object.keys(response.data)) {
          let i = document.createElement("i");
          i.classList.add("icons", "icon-trash");

          let text = document.createTextNode(" " + response.data[key].name);

          let button = document.createElement("button");
          button.classList.add(
            "btn",
            "btn-sm",
            "btn-outline-danger",
            "mr-2",
            "mb-2",
          );
          button.type = "button";
          button.addEventListener(
            "click",
            () => {
              if (
                !confirm(`${response.data[key].name}を削除しますか？
同時にアカウントとの関連も解除されます。`)
              )
                return;
              this.removeMaster(name, response.data[key].id);
            },
            false,
          );

          button.appendChild(i);
          button.appendChild(text);
          body.appendChild(button);
        }
      })
      .catch((error) => {
        this.overlayOut();
        console.error(error);
      });
  }

  /**
   * @param string name
   * @param string id
   * @return void
   */
  removeMaster(name, id) {
    this.overlay();
    window.axios
      .post("/webapi/" + name + "/" + id + "/delete")
      .then((response) => {
        // console.log(response);
        this.listMasters(name);
      })
      .catch((error) => {
        this.overlayOut();
        console.error(error);
      });
  }

  /**
   * @param [DOM object] element
   * @return void
   */
  removeChildren(element) {
    if (!element) return;

    while (element.firstChild) {
      element.removeChild(element.firstChild);
    }
  }

  /**
   * @param string key
   * @return string
   */
  trance(key) {
    return key in window.lang ? window.lang[key] : key;
  }
}

window.Common = new Common();
