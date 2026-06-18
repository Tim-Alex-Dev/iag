jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Toggle
	 */
	$(document).on('click', '.js-toggle', function (e) {
		e.preventDefault();
		const item = $(this).data('item');
		if ('' !== item) {
			$(this).toggleClass('is-open');
			$('#' + item).toggleClass('is-open').slideToggle();
		}
	});

});
