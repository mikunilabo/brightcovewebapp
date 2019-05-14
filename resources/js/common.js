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
    button.classList.add("btn", "btn-outline-danger");
    button.type = "button";
    button.addEventListener(
      "click",
      () => {
        window.Common.removeElement(listId);
      },
      false,
    );
    button.appendChild(i);

    var span = document.createElement("span");
    span.classList.add("input-group-append");
    span.appendChild(button);

    var input = document.createElement("input");
    var inputId = "ta-" + name + "-" + cnt.value;
    input.id = inputId;
    input.classList.add("form-control", "typeahead");
    input.name = name + "[" + cnt.value + "]";
    input.type = "text";
    input.value = "";
    input.autocomplete = "off";

    var inputGroup = document.createElement("div");
    inputGroup.classList.add("input-group");
    inputGroup.appendChild(input);
    inputGroup.appendChild(span);

    var child = document.createElement("div");
    child.id = listId;
    child.classList.add("form-group", "col-md-6");
    child.appendChild(inputGroup);

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
    //        setTimeout(function(){
    //            $("#overlay").fadeOut(500);
    //        },3000);
  }

  /**
   * @return void
   */
  overlayOut() {
    $("#overlay").fadeOut(500);
  }

  /**
   * @param string name
   * @return void
   */
  listMasters(name) {
    var body = document.getElementById(name + "-modal-body");
    while (body.firstChild) {
      body.removeChild(body.firstChild);
    }

    window.axios
      .get("/webapi/" + name)
      .then(response => {
        window.Common.overlayOut();
        body.innerHtml = "";

        for (let key of Object.keys(response.data)) {
          var input = document.createElement("input");
          input.type = "checkbox";
          input.classList.add("form-check-input");
          input.addEventListener(
            "change",
            () => {
              window.Common.removeMaster(name, response.data[key].id);
            },
            false,
          );

          var label = document.createElement("label");
          label.classList.add("form-check-label");
          label.appendChild(input);
          var text = document.createTextNode(response.data[key].name);
          label.appendChild(text);

          var div = document.createElement("div");
          div.classList.add("form-check", "form-check-inline", "mr-3");
          div.appendChild(label);

          body.appendChild(div);
        }
      })
      .catch(error => {
        window.Common.overlayOut();
        console.log(error);
      });
  }

  /**
   * @param string name
   * @param string id
   * @return void
   */
  removeMaster(name, id) {
    window.Common.overlay();
    window.axios
      .post("/webapi/" + name + "/" + id + "/delete")
      .then((response) => {
        console.log(response);
        window.Common.listMasters(name);
      })
      .catch(error => {
        window.Common.overlayOut();
        console.log(error);
      });
  }
}

window.Common = new Common();
