// Small site-wide snippets and inits, too small for their own component file
import '../vendors/jquery.nice-select.min.js';

jQuery(document).ready(function ($) {
	"use strict";

	// styled <select> fields
	$('select').niceSelect();


	/**
	 * Share Button functionality
	 */
	$('.share-button').on('click', function () {
		const $button = $(this);
		const pageUrl = window.location.href;

		if (navigator.clipboard && navigator.clipboard.writeText) {
			navigator.clipboard.writeText(pageUrl).then(function () {
				showCopiedMessage($button);
			});
		} else {
			const $temp = $('<textarea>');

			$('body').append($temp);

			$temp
				.val(pageUrl)
				.select();

			document.execCommand('copy');

			$temp.remove();

			showCopiedMessage($button);
		}
	});

	function showCopiedMessage($button) {
		$button.addClass('is-copied');

		setTimeout(function () {
			$button.removeClass('is-copied');
		}, 2000);
	}


	// Observer for Animated Counter
	function observeElements(selector, callback, options = {}) {
		const elements = document.querySelectorAll(selector);

		if (!elements.length) {
			return;
		}

		const observer = new IntersectionObserver(
			(entries, currentObserver) => {
				entries.forEach((entry) => {
					if (!entry.isIntersecting) {
						return;
					}

					callback(entry.target);
					currentObserver.unobserve(entry.target);
				});
			},
			{
				threshold: 0.25,
				...options
			}
		);

		function isElementVisible(element) {
			const rect = element.getBoundingClientRect();

			return (
				rect.top < window.innerHeight &&
				rect.bottom > 0
			);
		}

		function checkElements() {
			elements.forEach((element) => {
				if (element.dataset.observed) {
					return;
				}

				if (isElementVisible(element)) {
					element.dataset.observed = 'true';
					callback(element);
				} else {
					observer.observe(element);
				}
			});
		}

		// Normal page opening
		checkElements();

		// Refresh with restored scroll position
		$(window).on('load pageshow', function () {
			requestAnimationFrame(checkElements);
		});
	}

	// Animated Counter
	function animateCounter(element) {
		const $counter = $(element);
		const finalValue = $counter.data('counter').toString();

		const target = parseInt(finalValue.replace(/\D/g, ''), 10);
		const prefix = finalValue.match(/^\D*/)?.[0] || '';
		const suffix = finalValue.match(/\D*$/)?.[0] || '';

		if (Number.isNaN(target)) {
			return;
		}

		$({ value: 0 }).animate(
			{ value: target },
			{
				duration: 2500,
				step: function (value) {
					$counter.text(
						prefix + Math.floor(value) + suffix
					);
				},
				complete: function () {
					$counter.text(finalValue);
				}
			}
		);
	}

	observeElements(
		'.animated-item .counter-item__title[data-counter]',
		animateCounter
	);

	// Sticky Header Script
	const $stickyHeader = $('.sticky-header');

	if ($stickyHeader.length) {
		let lastScrollTop = $(window).scrollTop();

		$(window).on('scroll', function () {
			const currentScrollTop = $(this).scrollTop();

			if (currentScrollTop <= 400) {
				$stickyHeader.removeClass('is-visible');
			} else if (currentScrollTop > lastScrollTop) {
				$stickyHeader.addClass('is-visible');
			} else {
				$stickyHeader.removeClass('is-visible');
			}

			lastScrollTop = currentScrollTop;
		}).trigger('scroll');
	}

	$('.resource-main__cta-trigger').on('click', function () {
		$(this).closest('.resource-main__cta').toggleClass('is-open');
	});
});
