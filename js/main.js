jQuery(document).ready(function($) {
	 $('body').prepend('<a href="#0" class="back-to-top"></a>');

	var amountScrolled = 300;
	var duration = 300;
	$back_to_top = $('.back-to-top');

	$(window).scroll(function () {
		if ($(window).scrollTop() > amountScrolled) {
			$back_to_top.fadeIn(duration);
		} else {
			$back_to_top.fadeOut(duration);
		}
	});

	$back_to_top.click(function (event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: 0
		}, duration
		);
		return false;
	});

	Handlebars.registerHelper("NumberCommaFormat", function(number) {
		return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	});

	Handlebars.registerHelper('ifequal', function(value, criteria, option) {
		if (value == criteria) {
			return option.fn(this);
		} else {
			return option.inverse(this);
		}
	});

	Handlebars.registerHelper('ifgreaterthan', function(value, criteria, option) {
		if (value > criteria) {
			return option.fn(this);
		} else {
			return option.inverse(this);
		}
	});
});

$.urlParam = function (name, url) {
    if (!url) {
        url = window.location.href;
    }

    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);
    
    if (!results) {
        return undefined;
    }

    return results[1] || undefined;
}

$.apiUrl = function () {
    var result = "";
    var clientUrl = location.protocol + "//" + location.host;

    var production = clientUrl.includes("planner");

    if (production) {
        result = clientUrl.replace("planner", "api"); // Production
    }
    else {
        result = clientUrl.replace("8080", "8081"); // Development
    }

    console.log("clientUrl: " + clientUrl);
    return result;
}

function NumberCommaFormat(number) {
	return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

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
                    $(this).unhighlight();
                    $(this).highlight(filter);
                });
            });
        }
    });
})(jQuery);

$.extend({
    highlight: function (node, re, nodeName, className) {
        if (node.nodeType === 3) {
            var match = node.data.match(re);

            if (match) {
                var highlight = document.createElement(nodeName || 'span');
                highlight.className = className || 'highlight';

                var wordNode = node.splitText(match.index);
                wordNode.splitText(match[0].length);

                var wordClone = wordNode.cloneNode(true);
                highlight.appendChild(wordClone);

                wordNode.parentNode.replaceChild(highlight, wordNode);

                return 1;
            }
        } else if ((node.nodeType === 1 && node.childNodes) && !/(script|style)/i.test(node.tagName) && !(node.tagName === nodeName.toUpperCase() && node.className === className)) {
            for (var i = 0; i < node.childNodes.length; i++) {
                i += $.highlight(node.childNodes[i], re, nodeName, className);
            }
        }

        return 0;
    }
});

$.fn.unhighlight = function () {
    var settings = { className: 'highlight', element: 'span' };
    $.extend(settings);

    return this.find(settings.element + "." + settings.className).each(function () {
        var parent = this.parentNode;
        parent.replaceChild(this.firstChild, this);
        parent.normalize();
    }).end();
};

$.fn.highlight = function (words) {
    var settings = { className: 'highlight', element: 'span' };
    $.extend(settings);

    if (words.constructor === String) {
        words = [words];
    }

    words = $.grep(words, function (word, i) {
        return word != '';
    });

    words = $.map(words, function (word, i) {
        return word.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
    });

    if (words.length == 0) { return this; };

    var pattern = "(" + words.join("|") + ")";

    var re = new RegExp(pattern, "i");

    return this.each(function () {
        $.highlight(this, re, settings.element, settings.className);
    });
};
