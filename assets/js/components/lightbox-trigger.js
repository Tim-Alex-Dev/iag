// A click on a [data-fancybox] link before the lightbox module has loaded: load it now and open the clicked item
document.addEventListener('click', (e) => {
	const opener = e.target.closest('[data-fancybox]');
	if (!opener || window.itLightboxReady) {
		return;
	}

	e.preventDefault();
	e.stopPropagation();

	import(/* webpackChunkName: "lightbox" */ '../modules/lightbox')
		.then(({Fancybox}) => Fancybox.fromOpener('[data-fancybox]', {target: opener}))
		.catch(error => console.error('Lightbox failed to load', error));
}, true);
