jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Toggle Adminbar display
	 */
	if ($('body').hasClass('admin-bar')) {
		// Remove extra top margin when adminbar is active on front-end
		$('html').css({'cssText': 'margin-top: 0 !important'});

		// Toggle adminbar
		$('#wp-admin-bar-site-name').on('click', function (e) {
			e.stopPropagation();
			$('#wpadminbar').toggleClass('is-expanded');
		});
	}
});
