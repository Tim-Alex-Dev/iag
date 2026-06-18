jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Header scrolled
	 */
	function checkScrollPosition() {
		let st = $(window).scrollTop();

		if ($('body').hasClass('is-menu-open')) {
			return;
		}

		if (st > 70) {
			$('body').addClass('is-scrolled');
		} else {
			$('body').removeClass('is-scrolled');
		}
	}

	$(window).on('load scroll', function (e) {
		checkScrollPosition();
	});

});
