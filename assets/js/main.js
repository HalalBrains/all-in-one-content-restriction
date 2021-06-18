"use strict";

(function ($) {
	var heymehedi = {
		formSubmission: function () {
			
			var posttype = $('#post-type').val();

			$('#heymehedi-submit').on('click', function () {
				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "content_restriction_update_settings",
						"posttype": posttype,
					}, function (data) {
						console.log(data);
					}
				);

				return false;
			});

			$('#post-type').on('click', function () {
				
				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "content_restriction_post_type",
						"posttype": posttype,
					}, function (data) {
						console.log(data);
						$('#heymehedi-items_table_body').html(data);
					}
				);

			});

			$("#heymehedi-search_bar").on("keyup", function() {
				var value = $(this).val().toLowerCase();
				$("#heymehedi-items_table_body tr").filter(function() {
				  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});
			  });

			

		},




	};


	$(document).ready(function () {
		heymehedi.formSubmission();
	});

	$(window).on('load', function () {
	});

})(jQuery);