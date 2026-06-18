window.onload = function (e) {

	const toTop = document.getElementById('to-top');
	if (toTop) {
		window.addEventListener('scroll', (e) => {
			if (window.scrollY > 300) {
				toTop.classList.add('show');
			} else {
				toTop.classList.remove('show');
			}
		});

		toTop.addEventListener('click', () => {
			// Remove hash from url
			setTimeout(() => {
				history.replaceState('', document.title, window.location.origin + window.location.pathname + window.location.search);
			}, 5);
		});
	}

};
