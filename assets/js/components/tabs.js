jQuery(document).ready(function ($) {

	"use strict";

	/**
	 * Tabs
	 */
	$(document).on('click', '.js-tab-title', function () {

		const tabs = $(this).closest('.js-tabs'),
			item = $(this).data('item'),
			url = $(this).data('url');

		if (url && $(this).hasClass('is-active')) {
			window.open(url, '_blank', 'noopener,noreferrer');
			return;
		}

		if ('' !== item) {
			tabs.find('.js-tab-title').removeClass('is-active');
			$(this).addClass('is-active');
			tabs.find('.js-tab-content').removeClass('is-active');
			tabs.find('#' + item).addClass('is-active');
		}
	});
});