jQuery(document).ready(function ($) {
	"use strict";

	const tocListWrapper = $('.table-of-content'),
		  tocList        = $('#table_of_content');

	if (!tocListWrapper.length || !tocList.length) {
		return;
	}

	let hasHeadings = false;

	const postWrapper = $('.single-resource .resource-main__content, .system-page__main-content');

	postWrapper.find('h2, h3, h4, h5, h6').each(function (index, element) {
		const $heading = $(element);

		if ($heading.closest('section').hasClass('m-cases')) {
			return;
		}

		const headingText = $heading.text(),
			  headingTag  = $heading.prop('tagName').toLowerCase(),
			  headingId   = 'heading-' + index;

		$heading.attr('id', headingId);

		const listItem = $(
			'<li class="heading-' + headingTag + '">' +
				'<a href="#" data-heading="' + headingId + '">' +
					headingText +
				'</a>' +
			'</li>'
		);

		tocList.append(listItem);
		hasHeadings = true;
	});

	if (hasHeadings) {
		tocListWrapper.removeClass('hidden');
	} else {
		tocListWrapper.remove();
	}

	tocList.on('click', 'a', function (e) {
		e.preventDefault();

		const headingId = $(this).data('heading'),
			  target    = $('#' + headingId);

		if (target.length) {
			$('html, body').animate({
				scrollTop: target.offset().top - 100
			}, 500);
		}
	});
});