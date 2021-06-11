"use strict";

(function ($) {
	var theme = {
		preloader: function () {
			$('#theme-preloader').fadeOut('slow', function () {
				$(this).remove();
			});
		},

		tinyslider: function () {
			if (typeof tns != 'undefined') {
				$(".theme-testimonial-slider__sliding").each(function () {
					var options = $(this).data('options');
					options.container = this;
					tns(options);
				});
			}
		},

		counterUpPlugin: function () {
			$(".theme-counter__counter").each(function () {
				var options = $(this).data('options');
				$(this).counterUp(options);
			});
		},


		//slider range
		sliderRange: function () {
			var slider_range = $(".slider-range");
			const priceRangeMin = document.querySelector('.amount').getAttribute('data-min-price');
			const priceRangeMax = document.querySelector('.amount').getAttribute('data-max-price');
			slider_range.each(function () {
				$(this).slider({
					range: true,
					min: 0,
					max: 1000,
					values: [priceRangeMin, priceRangeMax],
					slide: function (event, ui) {
						$(".amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
						$(".price-range__input-values__min").val(ui.values[0]);
						$(".price-range__input-values__max").val(ui.values[1]);
					}
				});
			});

			$(".amount").text("$" + slider_range.slider("values", 0) + " - $" + slider_range.slider("values", 1));
			$(".price-range__input-values__min").val(slider_range.slider("values", 0));
			$(".price-range__input-values__max").val(slider_range.slider("values", 1));
		},

		dashboardProfileText: function () {

			var buttonArea = document.querySelector(".ezmu__media-picker-buttons");

			// ------ Create New P element ------- //
			var div = document.createElement('div');

			// Add class 
			$(div).html('list-group-item');

			// Add text node with input value
			$(buttonArea).append(div);

		}

	};

	function content_ready_scripts() {
		theme.counterUpPlugin();
	}

	function content_load_scripts() {
		theme.tinyslider();
		theme.sliderRange();
	}

	$(document).ready(function () {
		content_ready_scripts();
	});

	$(window).on('load', function () {
		content_load_scripts();
		theme.preloader();
	});

	$(window).on('elementor/frontend/init', function () {
		if (elementorFrontend.isEditMode()) {
			elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
				content_ready_scripts()
				content_load_scripts();
			});
		}
	});


	//mobile menu fix
	$(".menu-item.menu-item-has-children").on("click", function () {
		$(this).toggleClass("active");
	});

	//search categories
	var search_field = $(".top-search-field");
	search_field.on("click", function (e) {
		$(".top-search-field").parents(".search_module,.navbar-nav").addClass("active");
		e.stopPropagation();
	});

	//add class and remove class search area
	$('#search-icon').click(function () {
		$("i", this).toggleClass("la-search la-times");
	});
	$('.theme-listing-details-card__right--btn').click(function () {
		$(this).toggleClass("active");
	});

	//search categories
	var search_field = $(".top-search-field");
	search_field.on("click", function (e) {
		$(".top-search-field").parents(".search_module,.navbar-nav").addClass("active");
		e.stopPropagation();
	});
	//navbar search module
	$(document).on("click", function () {
		$(".search_module,.navbar-nav").removeClass("active");
	});
	//search categories
	var search_field = $(".first-wrap--main");
	search_field.on("click", function (e) {
		$(".first-wrap--main").parents(".search_module").addClass("active");
		e.stopPropagation();
	});
	$('#search-menu').removeClass('toggled');

	$('#search-icon').click(function (e) {
		e.stopPropagation();
		$('#search-menu,.navbar-collapse').toggleClass('toggled');
		$("#popup-search").focus();
	});

	$('#search-menu input').click(function (e) {
		e.stopPropagation();
	});
	// enable bootstrap tooltip
	$('[data-toggle="tooltip"]').tooltip();


	// Validate contact form
	$('.dlawyers-grid-cont-btn').on('click', function () {
		const listingID = $(this).attr('data-listing_id');
		const listing_email = $(this).attr('data-listing_email');
		if (listingID || listing_email) {
			$('[name=atbdp-post-id]').val(listingID);
			$('[name=atbdp-listing-email]').val(listing_email);
		}
	});

	$('body').on('submit', '#dlawyers-contact-owner-form', function (e) {
		e.preventDefault();

		$('#dlawyers-contact-message-display').append('<div class="atbdp-spinner"></div>');

		// Post via AJAX
		const data = {
			action: 'atbdp_public_send_contact_email',
			post_id: $('#atbdp-post-id').val(),
			name: $('#atbdp-contact-name').val(),
			email: $('#atbdp-contact-email').val(),
			listing_email: $('#atbdp-listing-email').val(),
			message: $('#atbdp-contact-message').val(),
		};

		$.post(
			dlawyers_localize_data.ajaxurl,
			data,
			function (response) {
				if (response.error == 1) {
					$('#dlawyers-contact-message-display')
						.addClass('text-danger')
						.html(response.message);
				} else {
					$('#atbdp-contact-message').val('');
					$('#dlawyers-contact-message-display')
						.addClass('text-success')
						.html(response.message);
				}
			},
			'json'
		);
	});


	var myVariable = ".directorist-advanced-filter__advanced--review .filter-checklist__label,.directorist-advanced-filter__advanced--age label:first-child,.directorist-advanced-filter__advanced--tag label:first-child,.directorist-advanced-filter__advanced--radio label:first-child";

	$(myVariable).append("<span>more</span>");
	const toggles = document.querySelectorAll(myVariable);
	toggles.forEach((toggle) => {
		toggle.addEventListener("click", () => {
			toggle.parentNode.classList.toggle("active");
		});
		toggle.parentNode.classList.add("active");
	});

})(jQuery);