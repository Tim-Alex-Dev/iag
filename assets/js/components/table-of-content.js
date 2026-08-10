jQuery(document).ready(function ($) {
	"use strict";

	if ($('.single-resource').length > 0) {
		let hasHeadings      = false;
		const postWrapper    = $('.resource-main__content'),
			  tocListWrapper = $('.table-of-content'),
			  tocList        = $('#table_of_content');

		postWrapper.find('h2, h3, h4, h5, h6').each(function (index, element) {
			let headingText = $(element).text(),
				headingTag  = $(element).prop('tagName').toLowerCase(),
				headingId   = 'heading-' + index;

			if ($(element).closest('section').hasClass('m-cases')) {
				return;
			}

			$(element).attr('id', headingId);

			let listItem = $(
				'<li class="heading-' + headingTag + '">' +
					'<a href="#" data-heading="' + headingId + '">' +
						headingText +
					'</a>' +
				'</li>'
			);

			tocList.append(listItem);
			hasHeadings = true;
		});

		hasHeadings
			? tocListWrapper.removeClass('hidden')
			: tocListWrapper.remove();

		$('#table_of_content a').on('click', function (e) {
			e.preventDefault();

			let headingId = $(this).data('heading'),
				target    = $('#' + headingId);

			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top - 100
				}, 500);
			}
		});
	}
});