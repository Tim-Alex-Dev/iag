import Swiper from 'swiper';
import {Navigation, Pagination, Autoplay, A11y} from 'swiper/modules'; // only the used modules (+ their CSS in 3-vendors/_swiper-bundle.scss)
import {isShown} from '../functions/first-screen';

jQuery(document).ready(function ($) {
	"use strict";

	// Lazy images of the next slides load now (the module loads when a slider comes near the screen), not when they
	// slide in. Sliders in hidden tabs: when their tab title is pointed at (components/tabs.js).
	document.querySelectorAll('.swiper').forEach((slider) => {
		if (isShown(slider)) {
			slider.querySelectorAll('img[loading="lazy"]').forEach((img) => {
				if (img.complete) {
					return; // already loaded: switching would make the browser pick its file again
				}
				img.loading = 'eager';
			});
		}
	});

	/**
	 * Sliders
	 */
	document.querySelectorAll('.m-experience__swiper').forEach((slider) => {
		new Swiper(slider, {
			modules: [Navigation, Pagination, Autoplay, A11y],
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
				el: slider.querySelector('.m-experience__swiper-pagination'),
				dynamicBullets: true,
				clickable: true,
			},
		});
	});

	// Simple Slider and Stars modules share the same slider settings
	['m-slider', 'm-stars'].forEach((module) => {
		document.querySelectorAll('.' + module + '__swiper').forEach((slider) => {
			const wrapper = slider.closest('.' + module);

			new Swiper(slider, {
				modules: [Navigation, Pagination, Autoplay, A11y],
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
					nextEl: wrapper.querySelector('.' + module + '__swiper-button-next'),
					prevEl: wrapper.querySelector('.' + module + '__swiper-button-prev'),
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
			modules: [Navigation, Pagination, Autoplay, A11y],
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

});
