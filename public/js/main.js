"use strict";

(function ($) {
	var heymehedi = {

		protectEverything: function () {

			let isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
			let body = $('body');
			let image = $('img');

			if (all_in_one_content_restriction_main_localize_data['contextmenu'] == 'Y') {
				body.on('contextmenu', function (e) {
					alert('contextmenu_text');
					e.preventDefault();
					return false;
				});
			}

			if (all_in_one_content_restriction_main_localize_data['drag'] == 'Y') {
				body.on("cut copy paste", function (e) {
					alert('drag_text');
					return false;
				});

				body.on('keydown', function (e) {
					if ((e.metaKey) && e.which == 67) {
						e.preventDefault();
						alert('drag_text');
						return false;
					}
				});

				image.on('contextmenu dragstart', function (e) {
					alert('drag_text');
					e.preventDefault();
					return false;
				});

				if (isMobile) {
					image.on('touchstart', function (e) {
						image.css({
							'-webkit-touch-callout': 'none', '-webkit-user-select': 'none',
							'pointer-events': 'none', '-moz-user-select': 'none'
						});
						alert('drag_text');
						e.preventDefault();
						return false;
					});
				}
			}

			if (all_in_one_content_restriction_main_localize_data['diskey'] == 'Y') {
				body.on('keypress', function () {
					return false;
				});

				window.addEventListener('keydown', function (e) {
					if ([32, 37, 38, 39, 40].indexOf(e.keyCode) > -1) {
						e.preventDefault();
					}
				}, false);

				if (isMobile) {
					body.on('touchstart', function () {
						$('input, textarea').prop('disabled', true);
					});
				}
			}
		},
	}


	$(document).ready(function () {
		// heymehedi.protectEverything();
	});

	$(window).on('load', function () {
		// heymehedi.select2js();
	});

})(jQuery);