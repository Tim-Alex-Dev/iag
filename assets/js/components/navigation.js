import vars from '../_vars';

jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Toggle main menu
	 */
	$('.icon-burger').on('click', function () {
		$('body').toggleClass('is-menu-open');
	});

	$('.main-menu li:not(.menu-item-has-children) > a').on('click', function () {
		$('body').removeClass('is-menu-open');
	});

	// autoclose mobile menu when increasing window width
	function closeMobileMenu() {
		$('.main-menu .sub-menu, .footer-links .sub-menu').css('display', '');
		if ($(window).width() >= vars.bp.lg) {
			if ($('body').hasClass('is-menu-open')) {
				$('.icon-burger').trigger('click');
			}
		}
	}

	$(window).on('resize', function (e) {
		closeMobileMenu();
	});


	/**
	 * Toggle mobile sub menu
	 */
	$('.main-menu .menu-item-has-children, .footer-links .menu-item-has-children').on('click', function (e) {
		const el = $(this),
			topEl = $(this).parent();
		if ($(window).width() < vars.bp.lg) {
			e.stopPropagation();
			if (el.hasClass('active')) {
				el.removeClass('active');
				el.find('> .sub-menu').slideUp();
			} else {
				topEl.find('> .sub-menu').slideUp();
				topEl.find('.menu-item-has-children').removeClass('active');
				el.addClass('active');
				el.find('> .sub-menu').slideDown();
			}
		}
	});

});
