"use strict";

(function ($) {
	var heymehedi = {

		deleteRestrictionItem: function () {

			$('.submitdelete').click(function (e) {
				e.preventDefault();
				if (window.confirm('Are you sure?')) {

					$(this).parents("tr").remove();

					$.post(
						heymehedi_object.ajaxurl,
						{
							"action": "all_in_one_content_restriction_delete_restrictions",
							"restriction_id": $(this).data('id'),
						}, function (data) {

						}
					);
				}
			});

		},

		formSubmission: function () {

			$(document).on('click', '#heymehedi-submit', function () {


				var actionType = $('#heymehedi-action').val();
				if ('edit' === actionType) {
					var restrictionID = $('#heymehedi-action').attr('data-restriction-id');
				}

				var title = $('#title').val();
				var priority = $('#priority').val();

				var posttype = $('#post-type').val();
				var restrictionIn = $('#restriction-in').val();

				var protectionType = $('#protection_type').val();
				var roles = $('#roles').val();

				var itemIds = [];
				$('#heymehedi-selected_items_table_body tr').each(function (index, element) {
					var itemId = $(this).data('item-id');
					itemIds.push(itemId)
				});

				var protectionType = $('#protection_type').val();

				// Override Contents
				var theTitle = $('#heymehedi_the_title').val();
				var theExcerpt = $('#heymehedi_the_excerpt').val();
				if ($('#wp-heymehedi_custom_editor-wrap').hasClass('tmce-active')) {
					var textEditor = tinymce.activeEditor.getContent();
				} else {
					var textEditor = $('#heymehedi_custom_editor').val();
				}

				var redirectionType = $('#redirection_type').val();
				var customUrl = $('#custom_url').val();

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "all_in_one_content_restriction_update_settings",
						"action_type": actionType,
						"restriction_id": restrictionID,
						"title": title,
						"priority": priority,
						"post_type": posttype,
						"restrict_in": restrictionIn,
						"protection_type": protectionType,

						"role_names": roles,
						"selected_ids": itemIds,

						"protectionType": protectionType,

						// Override Contents
						"the_title": theTitle,
						"the_excerpt": theExcerpt,
						"the_content": textEditor,

						// Redirection
						"redirectionType": redirectionType,
						"customUrl": customUrl,


					}, function (data) {
						if (data) {
							var data = JSON.parse(data);
							$('#heymehedi-msg').html(data.msg);
							$('#heymehedi-action').val('edit')
							$('#heymehedi-action').attr('data-restriction-id', data.restriction_id);
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

		restrictionIn: function () {
			$(document).on('click', '#post-type', function () {

				var postType = $(this).val();
				var restrictionIn = $('#restriction-in').val();

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "all_in_one_content_restriction_restrict_in",
						"post_type": postType,
						"restrict_in": restrictionIn,
					}, function (data) {
						if ('post' != postType) {
							$('#heymehedi-items-table-wrapper').hide();
						}
						$('#restriction-in').html(data);
					}
				);

				if ('post' === postType) {
					$.post(
						heymehedi_object.ajaxurl,
						{
							"action": "all_in_one_content_restriction_show_not_selected_items",
							"post_type": 'post',
							"restrict_in": 'category',
						}, function (data) {
							$('#heymehedi-items-table-wrapper').show();
							$('#heymehedi-items_table_body').html(data);
						}
					);
				}

			});
		},

		itemsQuery: function () {

			$(document).on('click', '#restriction-in', function () {

				var postType = $('#post-type').val();
				var restrictionIn = $(this).val();

				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "all_in_one_content_restriction_show_not_selected_items",
						"post_type": postType,
						"restrict_in": restrictionIn,
					}, function (data) {
						if ('nothing' === data) {
							$('#heymehedi-items-table-wrapper').hide();
						} else {
							$('#heymehedi-items-table-wrapper').show();
							$('#heymehedi-items_table_body').html(data);
						}
					}
				);

				// @Future Update
				$.post(
					heymehedi_object.ajaxurl,
					{
						"action": "all_in_one_content_restriction_show_selected_items",
						"restrict_in": restrictionIn,
						"post_type": postType,
					}, function (data) {
						$('span#restrict_in_title').html(data.restrict_in_title);
						$('#heymehedi-selected_items_table_body').html(data.markup);
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
							"action": "all_in_one_content_restriction_not_found_html",
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
							"action": "all_in_one_content_restriction_not_found_html",
						}, function (data) {
							$('#heymehedi-selected_items_table_body').prepend(data);
						},
					);
				}

			});

		},

		select2js: function () {
			$("#roles").select2({
				placeholder: "Select Roles",
				allowClear: true,
			});
		},

		protectionType: function () {
			let protectionType = $('#protection_type').val();

			var showHide = function (protectionType) {
				if ('login_and_back' === protectionType) {
					$("#roles_wrapper").hide();
					$("#override_contents").hide();
					$("#redirect").hide();
				}
				else if ('override_contents' === protectionType) {
					$("#roles_wrapper").show();
					$("#override_contents").show();
					$("#redirect").hide();
				}
				else if ('redirect' === protectionType) {
					$("#roles_wrapper").show();
					$("#override_contents").hide();
					$("#redirect").show();
				}
			}
			showHide(protectionType);

			$(document).on('click', '#protection_type', function () {
				let protectionType = $('#protection_type').val();
				showHide(protectionType);
			});
		},

		redirectionType: function () {
			let redirectionType = $('#redirection_type').val();

			var showHide = function (redirectionType) {
				if ('custom_url' === redirectionType) {
					$('.custom_url_box').show();
				} else {
					$('.custom_url_box').hide();
				}
			}
			showHide(redirectionType);

			$(document).on('click', '#redirection_type', function () {
				let redirectionType = $('#redirection_type').val();
				showHide(redirectionType);
			});
		}

	}


	$(document).ready(function () {

		heymehedi.deleteRestrictionItem();

		heymehedi.formSubmission();
		heymehedi.restrictionIn();
		heymehedi.itemsQuery();

		heymehedi.searchItems();
		heymehedi.addToSelectedTable();
		heymehedi.deleteFromSelectedTable();
		heymehedi.protectionType();
		heymehedi.redirectionType()

	});

	$(window).on('load', function () {
		heymehedi.select2js();
	});

})(jQuery);