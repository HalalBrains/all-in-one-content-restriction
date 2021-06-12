"use strict";

(function ($) {
	var heymehedi = {
		formSubmission: function () {


			$('#heymehedi-submit').on('click', function (e) {
				
				var posttype = $('#post-type').val();
				
				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "content_restriction_update_settings",
						"posttype": posttype
					}, function (data) {
						console.log(data);
					}
				);

				return false;

			});

		},




	};


	$(document).ready(function () {
		heymehedi.formSubmission();
	});

	$(window).on('load', function () {
	});



})(jQuery);