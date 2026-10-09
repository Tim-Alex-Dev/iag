import vars from './_vars';

// Helper functions:
import {throttle} from './functions/throttle';

// Plugins (NPM modules and uploaded files):
import Swiper, {Navigation, Pagination, Autoplay, Thumbs} from 'swiper/bundle'; // import Swiper bundle with all modules installed
// available Swiper.js modules = [Virtual, Keyboard, Mousewheel, Navigation, Pagination, Scrollbar, Parallax, Zoom, Lazy, Controller, A11y, History, HashNavigation, Autoplay, Thumbs, FreeMode, Grid, Manipulation, EffectFade, EffectCube, EffectFlip, EffectCoverflow, EffectCreative, EffectCards]
import './vendors/jquery.nice-select.min.js'; // jQuery Nice Select
import { Fancybox } from "@fancyapps/ui"; // Fancybox

jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Tweak for mobiles (full height)
	 */
	const fixFullheight = () => {
		const vh = window.innerHeight * 0.01;
		vars.htmlEl.style.setProperty('--vh', `${vh}px`);
	};

	fixFullheight();
	const fixHeight = throttle(fixFullheight);
	window.addEventListener('resize', fixHeight);


	/**
	 * Force load of all lazy-loading images
	 */
	setTimeout(function () {
		$('.lazyload.loading').removeClass('loading').addClass('loaded');
	}, 3000);


	/**
	 * Nice select
	 */
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


	/**
	 * Sliders
	 */
	document.querySelectorAll('.m-counter__slider-swiper').forEach((slider) => {
		new Swiper(slider, {
			spaceBetween: 12,
			loop: true,
			slidesPerView: 3,
			breakpoints: {
				640: {
					spaceBetween: 24,
				},
				1024: {
					spaceBetween: 40,
					slidesPerView: 5,
				},
				1440: {
					spaceBetween: 80,
					slidesPerView: 'auto',
				},
			},
			speed: 2500,
			autoplay: {
				delay: 0,
				disableOnInteraction: false,
			},
		});
	});

	document.querySelectorAll('.m-experience__swiper').forEach((slider) => {
		const wrapper = slider.closest('.m-experience').getAttribute('id');

		new Swiper(slider, {
			loop: false,
			spaceBetween: 24,
			slidesPerView: 1,
			breakpoints: {
				1024: {
					slidesPerView: 2,
					slidesPerGroup: 2,
				},
			},
			speed: 1000,
			pagination: {
				el: '#' + wrapper + ' .m-experience__swiper-pagination',
				dynamicBullets: true,
				clickable: true,
			},
		});
	});

	// Simple Slider and Stars modules share the same slider settings
	['m-slider', 'm-stars'].forEach((module) => {
		document.querySelectorAll('.' + module + '__swiper').forEach((slider) => {
			const wrapper = slider.closest('.' + module).getAttribute('id');

			new Swiper(slider, {
				loop: false,
				spaceBetween: 24,
				slidesPerView: 1,
				breakpoints: {
					640: {
						slidesPerView: 2,
					},
					1024: {
						slidesPerView: 4,
					},
				},
				speed: 1000,
				navigation: {
					nextEl: '#' + wrapper + ' .' + module + '__swiper-button-next',
					prevEl: '#' + wrapper + ' .' + module + '__swiper-button-prev',
				},
			});
		});
	});

	// Partnership logos: two endless rows
	document.querySelectorAll('.m-partnership__swiper-top, .m-partnership__swiper-bottom').forEach((slider) => {
		if (slider.swiper) {
			return;
		}

		new Swiper(slider, {
			slidesPerView: 'auto',
			spaceBetween: 20,
			loop: true,
			speed: 6000,
			allowTouchMove: false,
			autoplay: {
				delay: 0,
				disableOnInteraction: false,
				pauseOnMouseEnter: false,
			},
		});
	});

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
