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

jQuery(document).ready(function($){
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
	})
});