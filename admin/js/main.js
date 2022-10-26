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

			$(document).on('click', '.heymehedi-submit', function (e) {

				e.preventDefault();

				var actionType = $('#heymehedi-action').val();
				if ('edit' === actionType) {
					var restrictionID = $('#heymehedi-action').attr('data-restriction-id');
				}

				var title = $('#title').val();
				var priority = $('#priority').val();

				if (null === priority || '' === priority) {
					return;
				}

				var posttype = $('#post-type').val();
				var restrictionIn = $('#restriction-in').val();

				var protectionType = $('#protection_type').val();

				var user_restriction_type = $('#user_restriction_type').val();
				var roles = $('#roles').val();
				var specify_users = $('#specify_users').val();

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

				// Blur
				var spread = $('#spread').val();
				var blur_level = $('#blur_level').val();
				var blurApplyTo = $('#blur_apply_to').val();

				// Obfuscate
				var obfuscateApplyTo = $('#obfuscate_apply_to').val();

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

						"user_restriction_type": user_restriction_type,
						"role_names": roles,
						"specify_users": specify_users,

						"selected_ids": itemIds,

						"protectionType": protectionType,

						// Override Contents
						"the_title": theTitle,
						"the_excerpt": theExcerpt,
						"the_content": textEditor,

						// Redirection
						"redirectionType": redirectionType,
						"customUrl": customUrl,

						// Blur
						"spread": spread,
						"blur_level": blur_level,
						"blur_apply_to": blurApplyTo,

						// Obfuscate
						"obfuscate_apply_to": obfuscateApplyTo,

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

				$('#post-type-dynamic-title').html(postType);

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
				placeholder: "Select users",
				allowClear: true,
			});
			$("#specify_users").select2({
				placeholder: "Specify users",
				allowClear: true,
			});


			$("#blur_apply_to").select2({
				placeholder: "Select",
				allowClear: true,
			});

			$("#obfuscate_apply_to").select2({
				placeholder: "Select",
				allowClear: true,
			});
		},

		protectionType: function () {

			let showSaveHideNext = function (restrictionIn, protectionType) {

				// 1st Step Save or New Button
				if (
					('the_blog_index' == restrictionIn
						|| 'all_items' == restrictionIn
						|| 'frontpage' == restrictionIn
					) && ('login_and_back' == protectionType
						|| 'hide_from_loop' == protectionType)
				) {
					$('.hide-next-first').hide();
					$('.hide-save-first').show();
				} else {
					$('.hide-next-first').show();
					$('.hide-save-first').hide();
				}

				// 2nd Step Save or New Button
				if ('login_and_back' == protectionType || 'hide_from_loop' == protectionType) {
					$('.hide-next').hide();
					$('.hide-save').show();
				} else {
					$('.hide-next').show();
					$('.hide-save').hide();
				}
			}

			let showHideUserRoles = function (protectionType) {
				if ('login_and_back' == protectionType) {
					$('#user_restriction_type_wrapper').hide();
				} else {
					$('#user_restriction_type_wrapper').show();
				}
			}

			let hideOtherSections = function (protectionType) {

				let protection_types = [
					'override_contents',
					'redirect',
					'blur',
					'obfuscate',
				];

				protection_types.forEach(element => {
					if (element === protectionType) {
						$(`#${element}`).show();
					} else {
						$(`#${element}`).hide();
					}
				});
			}

			let run = function () {
				let restrictionIn = $('#restriction-in').val();
				let protectionType = $('#protection_type').val();
				showSaveHideNext(restrictionIn, protectionType);
				hideOtherSections(protectionType);
				showHideUserRoles(protectionType);
			}

			// First Load
			run();

			// On Click
			$(document).on('click', '#protection_type', function () {
				run();
			});

			$(document).on('click', '#restriction-in', function () {
				run();
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
		},

		popover: function () {
			$(function () {
				if (typeof $.fn.popover != "function") {
					return;
				} else {
					$('[data-toggle="popover"]').popover({
						html: true
					});
				}
			})
		},

		sliderRange: function () {

			$(".slider-range").slider({
				value: 15,
			});

			let initBlurLevel = $('.blur_level').data('amount');
			$(".blur_level").slider("option", "value", initBlurLevel);
			let blurLevel = $(".blur_level").slider("option", "value");
			$('#blur_level').val(blurLevel);

			$(".blur_level").on("slide", function (event, ui) {
				$('#blur_level').val(ui.value);
			});

			let initSpread = $('.spread').data('amount');
			$(".spread").slider("option", "value", initSpread);
			let spread = $(".spread").slider("option", "value");
			$('#spread').val(spread);

			$(".spread").on("slide", function (event, ui) {
				$('#spread').val(ui.value);
			});
		},

		userControlType: function () {

			function showHide(type) {
				if ('roles' == type) {
					$('.roles-group').show();
					$('.specify_users-group').hide();
				} else {
					$('.roles-group').hide();
					$('.specify_users-group').show();
				}
			}

			let type = $('#user_restriction_type').val();
			showHide(type);

			$(document).on('click', '#user_restriction_type', function () {
				type = $('#user_restriction_type').val();
				showHide(type);
			});
		},
	}

	$(document).ready(function () {

		heymehedi.deleteRestrictionItem();

		heymehedi.formSubmission();
		heymehedi.restrictionIn();
		heymehedi.userControlType();
		heymehedi.itemsQuery();

		heymehedi.searchItems();
		heymehedi.addToSelectedTable();
		heymehedi.deleteFromSelectedTable();
		heymehedi.protectionType();
		heymehedi.redirectionType();

		heymehedi.popover();

		heymehedi.sliderRange();
	});

	$(window).on('load', function () {
		heymehedi.select2js();
	});

	// Optimze it. 
	$(document).ready(function () {

		var current_fs, next_fs, previous_fs; //fieldsets
		var opacity;

		var restrictionIn = $('#restriction-in').val();
		$('#restriction-in').click(function (e) {
			restrictionIn = $(this).val();
		});

		$(".next").click(function () {

			current_fs = $(this).parent();
			if ('the_blog_index' == restrictionIn || 'all_items' == restrictionIn || 'frontpage' == restrictionIn) {
				next_fs = $(this).parent().next().next();
			} else {
				next_fs = $(this).parent().next();
			}

			//show the next fieldset
			next_fs.show();
			//hide the current fieldset with style
			current_fs.animate({ opacity: 0 }, {
				step: function (now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					next_fs.css({ 'opacity': opacity });
				},
				duration: 600
			});
		});

		$(".previous").click(function () {

			current_fs = $(this).parent();
			if ('the_blog_index' == restrictionIn || 'all_items' == restrictionIn || 'frontpage' == restrictionIn) {
				previous_fs = $(this).parent().prev().prev();
			} else {
				previous_fs = $(this).parent().prev();
			}

			//show the previous fieldset
			previous_fs.show();

			//hide the current fieldset with style
			current_fs.animate({ opacity: 0 }, {
				step: function (now) {
					// for making fielset appear animation
					opacity = 1 - now;

					current_fs.css({
						'display': 'none',
						'position': 'relative'
					});
					previous_fs.css({ 'opacity': opacity });
				},
				duration: 600
			});
		});

		$('.radio-group .radio').click(function () {
			$(this).parent().find('.radio').removeClass('selected');
			$(this).addClass('selected');
		});

		$(".submit").click(function () {
			return false;
		})

	});
	// end

})(jQuery);