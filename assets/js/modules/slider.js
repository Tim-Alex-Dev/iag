import Swiper from 'swiper';
import {Navigation, Pagination, Autoplay, A11y} from 'swiper/modules'; // only the used modules (+ their CSS in 3-vendors/_swiper-bundle.scss)

jQuery(document).ready(function ($) {
	"use strict";

	/**
	 * Sliders
	 */
	document.querySelectorAll('.m-counter__slider-swiper').forEach((slider) => {
		new Swiper(slider, {
			modules: [Navigation, Pagination, Autoplay, A11y],
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
