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
    }

    /**
     * @param string name
     */
    createTypeAheadList(name) {
        var cnt = document.getElementById(name + '-list-cnt');
        var listId = name + '-list-' + cnt.value;

        var i = document.createElement('i');
        i.classList.add('icons', 'icon-close');

        var button = document.createElement('button');
        button.classList.add('btn', 'btn-outline-danger');
        button.type = 'button';
        button.addEventListener('click', () => { window.Common.removeElement(listId); }, false);
        button.appendChild(i);

        var span = document.createElement('span');
        span.classList.add('input-group-append');
        span.appendChild(button);

        var input = document.createElement('input');
        var inputId = 'typeahead-' + cnt.value;
        input.id = inputId;
        input.classList.add('form-control', 'typeahead');
        input.name = name + '[' + cnt.value + ']';
        input.type = 'text';
        input.value = '';
        input.autocomplete = 'off';

        var inputGroup = document.createElement('div');
        inputGroup.classList.add('input-group');
        inputGroup.appendChild(input);
        inputGroup.appendChild(span);

        var child = document.createElement('div');
        child.id = listId;
        child.classList.add('form-group', 'col-md-6');
        child.appendChild(inputGroup);

        var parent = document.getElementById(name + '-area');
        var target = document.getElementById(name + '-add-btn-area');
        parent.insertBefore(child, target);

        typeAhead('#' + inputId);
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
}

window.Common = new Common();
