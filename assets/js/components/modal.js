jQuery(document).ready(function ($) {

	"use strict";

	/**
	 * Create Modal
	 */

	const createModal = (modalId) => {
		const modal = $(`
			<div id="${modalId}" class="modal modal--dynamic">
				<div class="modal__overlay"></div>

				<div class="modal__inner">
				
					<div class="modal__content bg-white">
						<div class="modal__close js-modal-close" aria-label="Close modal">
							<svg>
								<use xlink:href="#close"></use>
							</svg>
						</div>
					</div>
				</div>
			</div>
		`);

		$('body').append(modal);

		return modal;
	};


	/**
	 * Open modal
	 */
	$(document).on('click', '.js-modal-open', function (e) {

		e.preventDefault();

		const trigger = $(this);
		const modalId = trigger.data('modal');

		if (!modalId) {
			return;
		}

		$('body')
			.removeClass('is-menu-open')
			.addClass('overflow-hidden');


		/**
		 * Create dynamic modal
		 */
		if (!$('#' + modalId).length) {

			const modal = createModal(modalId);


			/**
			 * Video modal
			 */
			if (modalId === 'video') {

				const videoContent = createVideoContent(trigger);

				if (!videoContent) {
					modal.remove();
					$('body').removeClass('overflow-hidden');
					return;
				}

				modal
					.addClass('modal--video')
					.find('.modal__content')
					.append(videoContent);

			}

		}

		$('#' + modalId).addClass('is-open');

	});


	/**
	 * Close Modal
	 */
	const closeModal = (modal) => {
		if (!modal.length) {
			return;
		}

		if (modal.hasClass('modal--dynamic')) {
			modal.remove();
		} else {
			modal.removeClass('is-open');
		}

		$('body').removeClass('overflow-hidden');
	};

	$(document).on('click', '.js-modal-close, .modal__overlay', function () {
		
		const modal = $(this).closest('.modal');
		closeModal(modal);

	});

	$(document).on('keydown', function (e) {
		if (e.key === 'Escape') {
			const modal = $('.modal.is-open').last();

			if (modal.length) {
				closeModal(modal);
			}
		}
	});

	/**
	 * Create video modal content
	 */
	const createVideoContent = (trigger) => {

		const videoType   = trigger.data('video-type');
		const videoUrl    = trigger.data('video-url');
		const videoFile   = trigger.data('video-file');
		const videoBanner = trigger.data('video-banner');

		let content = null;


		// *Embed / YouTube*
		if (videoType === 'embed' && videoUrl) {

			const embedUrl = getYouTubeEmbedUrl(videoUrl);

			if (!embedUrl) {
				return null;
			}

			content = $(`
				<div class="video-box video-box-embed">
					<iframe
						src="${embedUrl}"
						allow="autoplay; encrypted-media; picture-in-picture"
						allowfullscreen
					></iframe>
				</div>
			`);
		}

		// *Video File*
		if (videoType === 'file' && videoFile) {

			/**
			 * File with banner
			 */
			if (videoBanner) {

				content = $(`
					<div class="video-box video-box-file">

						<video
							src="${videoFile}"
							controls
							playsinline
							preload="metadata"
						></video>

						<img
							class="video-box__banner"
							src="${videoBanner}"
							alt=""
						>

						<div class="video-box__controls">
							<svg>
								<use xlink:href="#play-circle"></use>
							</svg>
						</div>

					</div>
				`);

			/**
			 * File without banner
			 */
			} else {

				content = $(`
					<video
						class="video-box video-box-file"
						src="${videoFile}"
						controls
						playsinline
						preload="metadata"
					></video>
				`);

			}
		}

		return content;

	};

	/**
	 * Convert YouTube URL to embed URL
	 */
	const getYouTubeEmbedUrl = (url) => {

		try {

			const parsedUrl = new URL(url);

			let videoId = '';

			// youtu.be/VIDEO_ID
			if (parsedUrl.hostname === 'youtu.be') {
				videoId = parsedUrl.pathname.substring(1);
			}

			// youtube.com/watch?v=VIDEO_ID
			if (
				parsedUrl.hostname === 'youtube.com' ||
				parsedUrl.hostname === 'www.youtube.com'
			) {
				videoId = parsedUrl.searchParams.get('v');

				// youtube.com/embed/VIDEO_ID
				if (!videoId && parsedUrl.pathname.startsWith('/embed/')) {
					videoId = parsedUrl.pathname.split('/embed/')[1];
				}

				// youtube.com/shorts/VIDEO_ID
				if (!videoId && parsedUrl.pathname.startsWith('/shorts/')) {
					videoId = parsedUrl.pathname.split('/shorts/')[1];
				}
			}

			if (!videoId) {
				return null;
			}

			return `https://www.youtube.com/embed/${videoId}`;

		} catch (error) {

			return null;

		}
	};

	/**
	 * Video Box
	 */
	$(document).on('click', '.modal .video-box__banner, .modal .video-box__controls', function () {

		const videoBox = $(this).closest('.video-box');
		const video = videoBox.find('video').get(0);

		if (!video) {
			return;
		}

		videoBox
			.find('.video-box__banner, .video-box__controls')
			.remove();

		video.play();

	});
});