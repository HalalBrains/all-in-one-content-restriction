"use strict";

(function ($) {
	var heymehedi = {

		formSubmission: function () {

			var posttype = $('#post-type').val();


			$(document).on('click', '#heymehedi-submit', function () {

				var itemIds = [];

				$('#heymehedi-selected_items_table_body tr').each(function (index, element) {
					var itemId = $(this).data('item-id');
					itemIds.push(itemId)
				});

				// console.log(itemIds);

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "content_restriction_update_settings",
						"posttype": posttype,
						"itemIds": itemIds,
					}, function (data) {
						console.log(data);
					}
				);

				return false;
			});


		},

		categoryQuery: function () {

			var posttype = $('#post-type').val();

			$('#post-type').on('click', function () {

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "content_restriction_post_type",
						"posttype": posttype,
					}, function (data) {
						$('#heymehedi-items_table_body').html(data);
					}
				);

			});

		},

		searchItems: function () {

			$("#heymehedi-search_bar").on("keyup", function () {

				var value = $(this).val().toLowerCase();

				$("#heymehedi-items_table_body tr").filter(function () {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
				});

			});

		},

		addToSelectedTable: function () {

			$(document).on('click', '#heymehedi-items_table_body .action', function () {

				var content = $(this).parent();

				$('#heymehedi-selected_items_table_body').prepend(content);



				$('#heymehedi-selected_items_table_body .dashicons-before').removeClass('dashicons-plus-alt2');
				$('#heymehedi-selected_items_table_body .dashicons-before').addClass('dashicons-minus');
			});

		},

		deleteFromSelectedTable: function () {

			$(document).on('click', '#heymehedi-selected_items_table_body .action', function () {

				var content = $(this).parent();

				$('#heymehedi-items_table_body').prepend(content);

				$('#heymehedi-items_table_body .dashicons-before').removeClass('dashicons-minus');
				$('#heymehedi-items_table_body .dashicons-before').addClass('dashicons-plus-alt2');
			});

		},


	}


	$(document).ready(function () {
		heymehedi.formSubmission();
		heymehedi.categoryQuery();
		heymehedi.searchItems();
		heymehedi.addToSelectedTable();
		heymehedi.deleteFromSelectedTable();
	});

	$(window).on('load', function () {
	});

})(jQuery);