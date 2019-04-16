class Common {
    constructor() {}

    /**
     * @param string url
     * @param string method
     * @return void
     */
    submitForm(url, method = 'post') {
        var form = document.getElementById('basic-form');
        form.action = url;
        form.method = method;
        form.submit();
    }
}

window.Common = new Common();
