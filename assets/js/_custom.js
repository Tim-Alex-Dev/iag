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
	// do not activate NiceSelect on those pages, where it might conflict with Select2
	if (!$('body').hasClass('woocommerce-account')) {
		$('select').niceSelect();
	}


	/**
	 * Trigger NiceSelect update after Woocommerce Update variations
	 */
	$(".variations_form").on("woocommerce_variation_has_changed", function () {
		$('.variations_form select').niceSelect('update');
	});


	/**
	 * Slider Images
	 */
	document.querySelectorAll('.swiper-images').forEach(slider => {
		const swiper = new Swiper(slider, {
			loop: true,
			autoplay: {
				delay: 2500,
				disableOnInteraction: false,
			},
			pagination: {
				el: slider.querySelector('.swiper-pagination'),
				clickable: true,
			},
			navigation: {
				nextEl: slider.querySelector('.swiper-button-next'),
				prevEl: slider.querySelector('.swiper-button-prev'),
			},
			on: {
				// lazy load images
				slideChange: function () {
					try {
						lazyLoadInstance.update();
					} catch (e) {
					}
				}
			}
		});
	});

});
