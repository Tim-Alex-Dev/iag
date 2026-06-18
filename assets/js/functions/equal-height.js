import vars from '../_vars';

/**
 * Equal-height elements
 * @param name - class || tag || data attribute
 * @param container - optional
 * @param breakpoint - window width from which we start equal height calculation (can be 0 - for all screens).
 *
 * example usage: equalHeight('.article__title') or equalHeight('h2', '.articles' );
 */
export const equalHeight = (element, container = 'body', breakpoint = vars.bp.lg) => {
	if (null != element) {
		document.querySelectorAll(container).forEach(wrapper => {
			let tallest = 0;
			const els = wrapper.querySelectorAll(element);

			if (window.innerWidth >= parseInt(breakpoint)) {
				els.forEach(el => el.style.removeProperty('height'));

				els.forEach(el => {
					const elHeight = el.offsetHeight;
					tallest = elHeight > tallest ? elHeight : tallest;
				});

				els.forEach(el => el.style.height = tallest + 'px');

			} else {
				els.forEach(el => el.style.removeProperty('height'));
			}
		});

	}
};
