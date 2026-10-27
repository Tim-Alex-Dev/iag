jQuery(document).ready(function ($) {

	"use strict";

	/**
	 * Tabs: the lazy images of a tab start loading when its title is pointed at, touched or focused (ready when it opens)
	 */
	$(document).on('mouseenter touchstart focusin', '.js-tab-title', function () {
		const item = $(this).data('item');

		if (item) {
			$(this).closest('.js-tabs').find('#' + item + ' img[loading="lazy"]').filter((i, img) => !img.complete).attr('loading', 'eager');
		}
	});

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