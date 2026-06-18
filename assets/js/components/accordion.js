jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Accordion
	 */
	$(document).on('click', '.js-accordion-title', function () {
		const accordion = $(this).closest('.js-accordion'),
			accordionItem = $(this).closest('.js-accordion-item');
		if (accordionItem.hasClass('is-open')) {
			accordionItem.removeClass('is-open');
			accordionItem.find('.js-accordion-content').stop().slideUp();
		} else {
			accordion.find('.js-accordion-item').removeClass('is-open');
			accordion.find('.js-accordion-content').stop().slideUp();
			accordionItem.addClass('is-open');
			accordionItem.find('.js-accordion-content').stop().slideDown();
		}
	});

});
