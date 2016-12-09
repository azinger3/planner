(function ($) {
    $.extend({
        tablefilter: function (defaults) {
            defaults = $.extend({
                inputElement: "",
                tableElement: ""
            }, defaults);

            $(defaults.inputElement).on('input propertychange keyup', function () {
                var filter = $(this).val();
                var rex = new RegExp(filter, 'i');

                $(defaults.tableElement + " tbody tr").hide();

                $(defaults.tableElement + " tbody tr").filter(function () {
                    return rex.test($(this).text());
                }).show();

                $(defaults.tableElement + " tbody tr td").filter(function (i, html) {
                    $(this).unhighlight(); // clear all hightlights
                    $(this).highlight(filter); // highlight matches based on the query string
                });
            });
        }
    });
})(jQuery);

$.extend({
    highlight: function (node, re, nodeName, className) {
        if (node.nodeType === 3) { // only nodes with textual content
            var match = node.data.match(re);

            if (match) {
                var highlight = document.createElement(nodeName || 'span');
                highlight.className = className || 'highlight';

                var wordNode = node.splitText(match.index);
                wordNode.splitText(match[0].length);

                var wordClone = wordNode.cloneNode(true);
                highlight.appendChild(wordClone);

                wordNode.parentNode.replaceChild(highlight, wordNode);

                return 1; // match found, move on to next node
            }

        } else if ((node.nodeType === 1 && node.childNodes) && // only element nodes that have children
            !/(script|style)/i.test(node.tagName) && // ignore script and style nodes
            !(node.tagName === nodeName.toUpperCase() && node.className === className)) { // skip if already highlighted

            // traverse through current node's children
            for (var i = 0; i < node.childNodes.length; i++) {
                i += $.highlight(node.childNodes[i], re, nodeName, className); // callback to look for textual content in child nodes
            }
        }

        return 0; // continue looking for matches in current node
    }
});

$.fn.unhighlight = function () {
    var settings = { className: 'highlight', element: 'span' };
    $.extend(settings);

    // find each highlighted element, replace with original element text
    return this.find(settings.element + "." + settings.className).each(function () {
        var parent = this.parentNode;
        parent.replaceChild(this.firstChild, this);
        parent.normalize();
    }).end();
};

$.fn.highlight = function (words) {
    var settings = { className: 'highlight', element: 'span' };
    $.extend(settings);

    // *** START cleansing the query string ***

    // intialize array from the query string
    if (words.constructor === String) {
        words = [words];
    }

    // filter out blanks in the array
    words = $.grep(words, function (word, i) {
        return word != '';
    });

    // replace special characters
    words = $.map(words, function (word, i) {
        return word.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    });

    // return empty if query string is blank
    if (words.length == 0) { return this; };

    // *** FINISHED cleansing the query string ***

    // build the regular expression that will be used to find matches
    var pattern = "(" + words.join("|") + ")";

    var re = new RegExp(pattern, "i");

    // start looping through the elements and find matches
    return this.each(function () {
        $.highlight(this, re, settings.element, settings.className);
    });
};