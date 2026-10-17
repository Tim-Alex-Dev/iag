import {minWidth} from '../functions/breakpoint';

jQuery(document).ready(function ($) {

	"use strict";

	/**
	 * Close mega menu
	 */
	function closeMegaMenu() {
		$('.menu-item-has-children.active')
			.removeClass('active')
			.find('> .mega-menu')
			.slideUp();

		$('body').removeClass('is-menu-open');

		// Remove outside click listener
		$(document).off('click.megaMenuOutside');
	}
	
	/**
	 * Close mega menu when clicking a link inside it
	 */
	$(document).on('click', '.mega-menu a', function () {
		closeMegaMenu();
	});

	/**
	 * Enable outside click listener
	 */
	function enableOutsideClick() {
		// Make sure we don't bind it twice
		$(document).off('click.megaMenuOutside');

		$(document).on('click.megaMenuOutside', function (e) {

			if (
				$(e.target).closest('.mega-menu').length ||
				$(e.target).closest('.menu-item-has-children > .menu-item__link').length
			) {
				return;
			}

			closeMegaMenu();
		});
	}


	// keep aria-expanded of the burger button in sync with the menu state (the menu can be closed by other scripts too)
	const burger = document.querySelector('.icon-burger');
	if (burger) {
		const syncBurger = () => burger.setAttribute('aria-expanded', document.body.classList.contains('is-menu-open') ? 'true' : 'false');
		syncBurger();
		new MutationObserver(syncBurger).observe(document.body, {attributes: true, attributeFilter: ['class']});
	}

	/**
	 * Toggle main menu
	 */
	$('.icon-burger').on('click', function () {

		$('body').toggleClass('is-menu-open');

		if (!$('body').hasClass('is-menu-open')) {
			closeMegaMenu();
		}

	});


	/**
	 * Close menu when clicking regular menu link
	 */
	$('.main-menu li:not(.menu-item-has-children) > a').on('click', function () {

		closeMegaMenu();

	});


	/**
	 * Autoclose mobile menu when increasing window width
	 */
	function closeMobileMenu() {

		$('.main-menu .sub-menu, .footer-links .sub-menu').css('display', '');

		if (minWidth('lg')) {

			if ($('body').hasClass('is-menu-open')) {
				closeMegaMenu();
			}

		}

	}

	$(window).on('resize', function () {

		closeMobileMenu();

	});


	/**
	 * Toggle mega menu
	 */
	$(document).on(
		'click',
		'.menu-item-has-children > .menu-item__link',
		function (e) {

			e.preventDefault();

			const $link    = $(this);
			const $item    = $link.closest('.menu-item-has-children');
			const $submenu = $item.find('> .mega-menu');

			/**
			 * Close current menu
			 */
			if ($item.hasClass('active')) {

				closeMegaMenu();

			/**
			 * Open menu
			 */
			} else {

				// Close other open mega menus
				$item
					.siblings('.menu-item-has-children')
					.removeClass('active')
					.find('> .mega-menu')
					.slideUp();

				$item.addClass('active');

				$submenu.slideDown();

				$('body').addClass('is-menu-open');

				enableOutsideClick();

			}

		}
	);

});