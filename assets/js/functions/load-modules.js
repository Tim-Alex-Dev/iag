/**
 * Loads modules (dist/js/modules/) only on pages that contain their selector: when such an element comes near the screen
 * (one screen ahead), or earlier on the first user interaction. Nothing loads on page load for elements further down
 * (keeps the main thread free for the first render). loadModules({ '.selector': () => import('../modules/name') })
 */

import {isShown} from './first-screen';

export const loadModules = (modules) => {
	const events = ['scroll', 'click', 'touchstart', 'keydown'];
	const pending = new Map(Object.entries(modules).filter(([selector]) => document.querySelector(selector)));
	let observer = null;

	const load = (selector) => {
		const module = pending.get(selector);
		if (!module) {
			return;
		}
		pending.delete(selector);
		module().catch(error => console.error(`Module for "${selector}" failed to load`, error));
	};

	const loadAll = () => {
		events.forEach(event => window.removeEventListener(event, loadAll));
		if (observer) {
			observer.disconnect();
		}
		[...pending.keys()].forEach(load);
	};

	if (!pending.size) {
		return;
	}

	// the first interaction loads the remaining modules at once
	events.forEach(event => window.addEventListener(event, loadAll, {once: true, passive: true}));

	if (!('IntersectionObserver' in window)) {
		return;
	}

	// otherwise: a module loads when one of its elements is less than one screen away
	observer = new IntersectionObserver((entries) => {
		entries.filter(entry => entry.isIntersecting && isShown(entry.target)).forEach((entry) => {
			[...pending.keys()].filter(selector => entry.target.matches(selector)).forEach(load);
			observer.unobserve(entry.target);
		});
	}, {rootMargin: '0px 0px 100% 0px'});

	pending.forEach((module, selector) => document.querySelectorAll(selector).forEach(el => observer.observe(el)));
};
