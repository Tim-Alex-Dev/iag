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
	$(document).on('click', '.menu-item-has-children > .menu-item__link', function (e) {
		e.preventDefault();

		const $link = $(this);
		const $item = $link.closest('.menu-item-has-children');
		const $submenu = $item.find('> .mega-menu');

		if ($item.hasClass('active')) {
			$item.removeClass('active');
			$submenu.slideUp();
		} else {
			$item.siblings('.menu-item-has-children').removeClass('active').find('> .mega-menu').slideUp();
			$item.addClass('active');
			$submenu.slideDown();
		}
	});

});
