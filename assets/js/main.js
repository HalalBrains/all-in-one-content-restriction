"use strict";

(function ($) {
	var heymehedi = {

		formSubmission: function () {

			$(document).on('click', '#heymehedi-submit', function () {

				var restrictionWise = $('#restriction-wise').val();
				var posttype = $('#post-type').val();

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
						"restrictionWise": restrictionWise,
					}, function (data) {
						console.log(data);
					}
				);

				return false;
			});


		},

		itemsQuery: function () {

			$(document).on('click', '#restriction-wise', function () {

				var restrictionWise = $(this).val();

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "content_restriction_wise",
						"restriction-wise": restrictionWise,
					}, function (data) {
						$('#heymehedi-items_table_body').html(data);
					}
				);

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "content_restriction_wise_selected",
						"restriction-wise": restrictionWise,
					}, function (data) {
						$('#heymehedi-selected_items_table_body').html(data);
					}
				);

			});

		},

		itemsOnLoad: function () {

			$.post(
				heymehedi_object.ajaxurl,
				{
					"action": "content_restriction_wise_on_load",
					// "restriction-wise": 'category',
					"type": "not-selected",
				}, function (data) {
					$('#heymehedi-items_table_body').html(data);
				}
			);

			$.post(
				heymehedi_object.ajaxurl,
				{
					"action": "content_restriction_wise_selected",
					// "restriction-wise": "category",
					"type": "selected",
				}, function (data) {
					$('#heymehedi-selected_items_table_body').html(data);
				}
			);
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
		heymehedi.itemsQuery();
		heymehedi.searchItems();
		heymehedi.addToSelectedTable();
		heymehedi.deleteFromSelectedTable();
	});

	$(window).on('load', function () {
		// heymehedi.itemsOnLoad();
	});

})(jQuery);