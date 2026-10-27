// HubSpot forms printed by it_hubspot_form() (inc/help-func.php): their scripts wait as type="text/plain".
// HubSpot v2.js (~200 KB) loads when a form comes near the screen or on the first user interaction (e.g. the click
// that opens the form modal), then each form script runs where it was: HubSpot puts the form right after it.
import {isShown} from '../functions/first-screen';

const forms = [...document.querySelectorAll('script[type="text/plain"][data-hs-form]')];

if (forms.length) {
	const events = ['mousemove', 'pointerdown', 'touchstart', 'keydown', 'scroll', 'click'];
	let started = false;
	let observer = null;

	const runForm = (placeholder) => {
		const script = document.createElement('script');
		script.textContent = placeholder.textContent;
		placeholder.replaceWith(script);
	};

	const start = () => {
		if (started) {
			return;
		}
		started = true;
		events.forEach(event => window.removeEventListener(event, start));
		if (observer) {
			observer.disconnect();
		}

		const loader = document.createElement('script');
		loader.src = forms[0].dataset.hsSrc;
		loader.charset = 'utf-8';
		loader.onload = () => forms.forEach(runForm);
		loader.onerror = () => console.error('HubSpot forms failed to load');
		document.head.appendChild(loader);
	};

	events.forEach(event => window.addEventListener(event, start, {once: true, passive: true}));

	// a visible form in (or near) the screen without any interaction, e.g. a page opened at #contacts (not a closed modal)
	if ('IntersectionObserver' in window) {
		observer = new IntersectionObserver(entries => entries.some(entry => entry.isIntersecting && isShown(entry.target)) && start(), {rootMargin: '300px 0px'});
		forms.forEach(form => observer.observe(form.parentElement));
	}
}
