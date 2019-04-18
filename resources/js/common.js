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

    /**
     * @param array strs
     * @return array
     */
    substringMatcher(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    	};
}

window.Common = new Common();
