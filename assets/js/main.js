"use strict";

(function ($) {
	var heymehedi = {

		formSubmission: function () {

			$(document).on('click', '#heymehedi-submit', function () {

				var restrictionIn = $('#restriction-in').val();
				var posttype = $('#post-type').val();
				var roles = $('#roles').val();
				var theTitle = $('#heymehedi_the_title').val();
				var theExcerpt = $('#heymehedi_the_excerpt').val();
				var textEditor = $('#heymehedi_custom_editor').val();
				var itemIds = [];

				$('#heymehedi-selected_items_table_body tr').each(function (index, element) {
					var itemId = $(this).data('item-id');
					itemIds.push(itemId)
				});

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "exlac_update_settings",
						"posttype": posttype,
						"itemIds": itemIds,
						"restrictionIn": restrictionIn,
						"roleNames": roles,
						"theTitle": theTitle,
						"theExcerpt": theExcerpt,
						"theContent": textEditor,
					}, function (data) {
						if (data) {
							$('#heymehedi-msg').html(data);
							window.setTimeout(function () {
								$('#heymehedi-msg').html('');

							}, 5000);
						} else {
							$('#heymehedi-msg').html('Something went wrong');
						}

					},
				);

				return false;
			});


		},

		itemsQuery: function () {

			$(document).on('click', '#restriction-in', function () {

				var restrictionIn = $(this).val();

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "exlac_show_not_selected_items",
						"restrictionIn": restrictionIn,
					}, function (data) {
						$('#heymehedi-items_table_body').html(data);
					}
				);

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "exlac_show_selected_items",
						"restrictionIn": restrictionIn,
					}, function (data) {
						$('#heymehedi-selected_items_table_body').html(data);
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

			$("#heymehedi-search_bar_selected").on("keyup", function () {

				var value = $(this).val().toLowerCase();

				$("#heymehedi-selected_items_table_body tr").filter(function () {
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
				$('#heymehedi-selected_items_table_body .not-found').remove();

				var length = $('#heymehedi-items_table_body tr').length;

				if (0 === length) {
					$.post(
						heymehedi_object.ajaxurl,
						{
							"action": "exlac_not_found_html",
						}, function (data) {
							$('#heymehedi-items_table_body').prepend(data);
						},
					);
				}
			});

		},

		deleteFromSelectedTable: function () {

			$(document).on('click', '#heymehedi-selected_items_table_body .action', function () {

				var content = $(this).parent();

				$('#heymehedi-items_table_body').prepend(content);
				$('#heymehedi-items_table_body .dashicons-before').removeClass('dashicons-minus');
				$('#heymehedi-items_table_body .dashicons-before').addClass('dashicons-plus-alt2');
				$('#heymehedi-items_table_body .not-found').remove();


				var length = $('#heymehedi-selected_items_table_body tr').length;

				if (0 === length) {
					$.post(
						heymehedi_object.ajaxurl,
						{
							"action": "exlac_not_found_html",
						}, function (data) {
							$('#heymehedi-selected_items_table_body').prepend(data);
						},
					);
				}

			});

		},

		select2js: function () {
			$("#roles").select2({
				placeholder: "Select roles",
				allowClear: true
			});
		},

		setHeight: function () {
			let part1 = document.querySelector('.part1').clientHeight;
			let part2 = document.querySelector('.part2').clientHeight;
			let part3 = document.querySelector('.part3').clientHeight;
			let height = (part1 + part2 + part3) - 110;
			$('#heymehedi-selected_items-wrapper').css('max-height', height + 'px');
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
		heymehedi.select2js();
		heymehedi.setHeight();

	});

})(jQuery);


