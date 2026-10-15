/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/js/_vars.js":
/*!****************************!*\
  !*** ./assets/js/_vars.js ***!
  \****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// Breakpoints (px): keep in sync with $grid-breakpoints (scss/0-settings/_!variables.scss). Use minWidth('lg') (functions/breakpoint.js)
/* harmony default export */ __webpack_exports__["default"] = ({
  bp: {
    md: 640,
    lg: 1024,
    xl: 1440,
    xxl: 1920
  }
});

/***/ }),

/***/ "./assets/js/components/_custom.js":
/*!*****************************************!*\
  !*** ./assets/js/components/_custom.js ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _vendors_jquery_nice_select_min_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../vendors/jquery.nice-select.min.js */ "./assets/js/vendors/jquery.nice-select.min.js");
/* harmony import */ var _vendors_jquery_nice_select_min_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_vendors_jquery_nice_select_min_js__WEBPACK_IMPORTED_MODULE_0__);
// Small site-wide snippets and inits, too small for their own component file

jQuery(document).ready(function ($) {
  "use strict";

  // styled <select> fields
  $('select').niceSelect();

  /**
   * Share Button functionality
   */
  $('.share-button').on('click', function () {
    const $button = $(this);
    const pageUrl = window.location.href;
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(pageUrl).then(function () {
        showCopiedMessage($button);
      });
    } else {
      const $temp = $('<textarea>');
      $('body').append($temp);
      $temp.val(pageUrl).select();
      document.execCommand('copy');
      $temp.remove();
      showCopiedMessage($button);
    }
  });
  function showCopiedMessage($button) {
    $button.addClass('is-copied');
    setTimeout(function () {
      $button.removeClass('is-copied');
    }, 2000);
  }

  // Observer for Animated Counter
  function observeElements(selector, callback, options = {}) {
    const elements = document.querySelectorAll(selector);
    if (!elements.length) {
      return;
    }
    const observer = new IntersectionObserver((entries, currentObserver) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) {
          return;
        }
        callback(entry.target);
        currentObserver.unobserve(entry.target);
      });
    }, {
      threshold: 0.25,
      ...options
    });
    function isElementVisible(element) {
      const rect = element.getBoundingClientRect();
      return rect.top < window.innerHeight && rect.bottom > 0;
    }
    function checkElements() {
      elements.forEach(element => {
        if (element.dataset.observed) {
          return;
        }
        if (isElementVisible(element)) {
          element.dataset.observed = 'true';
          callback(element);
        } else {
          observer.observe(element);
        }
      });
    }

    // Normal page opening
    checkElements();

    // Refresh with restored scroll position
    $(window).on('load pageshow', function () {
      requestAnimationFrame(checkElements);
    });
  }

  // Animated Counter
  function animateCounter(element) {
    const $counter = $(element);
    const finalValue = $counter.data('counter').toString();
    const target = parseInt(finalValue.replace(/\D/g, ''), 10);
    const prefix = finalValue.match(/^\D*/)?.[0] || '';
    const suffix = finalValue.match(/\D*$/)?.[0] || '';
    if (Number.isNaN(target)) {
      return;
    }
    $({
      value: 0
    }).animate({
      value: target
    }, {
      duration: 2500,
      step: function (value) {
        $counter.text(prefix + Math.floor(value) + suffix);
      },
      complete: function () {
        $counter.text(finalValue);
      }
    });
  }
  observeElements('.animated-item .counter-item__title[data-counter]', animateCounter);

  // Sticky Header Script
  const $stickyHeader = $('.sticky-header');
  if ($stickyHeader.length) {
    let lastScrollTop = $(window).scrollTop();
    $(window).on('scroll', function () {
      const currentScrollTop = $(this).scrollTop();
      if (currentScrollTop <= 400) {
        $stickyHeader.removeClass('is-visible');
      } else if (currentScrollTop > lastScrollTop) {
        $stickyHeader.addClass('is-visible');
      } else {
        $stickyHeader.removeClass('is-visible');
      }
      lastScrollTop = currentScrollTop;
    }).trigger('scroll');
  }
  $('.resource-main__cta-trigger').on('click', function () {
    $(this).closest('.resource-main__cta').toggleClass('is-open');
  });
});

/***/ }),

/***/ "./assets/js/components/accordion.js":
/*!*******************************************!*\
  !*** ./assets/js/components/accordion.js ***!
  \*******************************************/
/***/ (function() {

jQuery(document).ready(function ($) {
  "use strict";

  /**
   * Accordion
   */
  $(document).on('click', '.js-accordion-title', function () {
    const accordion = $(this).closest('.js-accordion'),
      accordionItem = $(this).closest('.js-accordion-item');
    if (accordionItem.hasClass('is-open')) {
      accordionItem.removeClass('is-open');
      accordionItem.find('.js-accordion-content').stop().slideUp();
    } else {
      accordion.find('.js-accordion-item').removeClass('is-open');
      accordion.find('.js-accordion-content').stop().slideUp();
      accordionItem.addClass('is-open');
      accordionItem.find('.js-accordion-content').stop().slideDown();
    }
  });
});

/***/ }),

/***/ "./assets/js/components/adminbar.js":
/*!******************************************!*\
  !*** ./assets/js/components/adminbar.js ***!
  \******************************************/
/***/ (function() {

jQuery(document).ready(function ($) {
  "use strict";

  // Admin bar on the front-end: hidden above the page (no top margin), opened with a click on the site name
  if ($('body').hasClass('admin-bar')) {
    $('html').css({
      'cssText': 'margin-top: 0 !important'
    });
    $('#wp-admin-bar-site-name').on('click', function (e) {
      e.stopPropagation();
      $('#wpadminbar').toggleClass('is-expanded');
    });
  }
});

/***/ }),

/***/ "./assets/js/components/header-scrolled.js":
/*!*************************************************!*\
  !*** ./assets/js/components/header-scrolled.js ***!
  \*************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _functions_throttle__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../functions/throttle */ "./assets/js/functions/throttle.js");

jQuery(document).ready(function ($) {
  "use strict";

  // .is-scrolled on <body> after 70px of scrolling
  const body = $('body');
  function checkScrollPosition() {
    if (body.hasClass('is-menu-open')) {
      return;
    }
    body.toggleClass('is-scrolled', window.scrollY > 70);
  }
  checkScrollPosition();
  window.addEventListener('scroll', (0,_functions_throttle__WEBPACK_IMPORTED_MODULE_0__.throttle)(checkScrollPosition, 100), {
    passive: true
  });
});

/***/ }),

/***/ "./assets/js/components/lightbox-trigger.js":
/*!**************************************************!*\
  !*** ./assets/js/components/lightbox-trigger.js ***!
  \**************************************************/
/***/ (function(__unused_webpack_module, __unused_webpack_exports, __webpack_require__) {

// A click on a [data-fancybox] link before the lightbox module has loaded: load it now and open the clicked item
document.addEventListener('click', e => {
  const opener = e.target.closest('[data-fancybox]');
  if (!opener || window.itLightboxReady) {
    return;
  }
  e.preventDefault();
  e.stopPropagation();
  Promise.all(/*! import() | lightbox */[__webpack_require__.e("vendors-node_modules_fancyapps_ui_dist_fancybox_esm_js"), __webpack_require__.e("lightbox")]).then(__webpack_require__.bind(__webpack_require__, /*! ../modules/lightbox */ "./assets/js/modules/lightbox.js")).then(({
    Fancybox
  }) => Fancybox.fromOpener('[data-fancybox]', {
    target: opener
  })).catch(error => console.error('Lightbox failed to load', error));
}, true);

/***/ }),

/***/ "./assets/js/components/modal.js":
/*!***************************************!*\
  !*** ./assets/js/components/modal.js ***!
  \***************************************/
/***/ (function() {

jQuery(document).ready(function ($) {
  "use strict";

  /**
   * Create Modal
   */
  const createModal = modalId => {
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
    $('body').removeClass('is-menu-open').addClass('overflow-hidden');

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
        modal.addClass('modal--video').find('.modal__content').append(videoContent);
      }
    }
    $('#' + modalId).addClass('is-open');
  });

  /**
   * Close Modal
   */
  const closeModal = modal => {
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
  const createVideoContent = trigger => {
    const videoType = trigger.data('video-type');
    const videoUrl = trigger.data('video-url');
    const videoFile = trigger.data('video-file');
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
  const getYouTubeEmbedUrl = url => {
    try {
      const parsedUrl = new URL(url);
      let videoId = '';

      // youtu.be/VIDEO_ID
      if (parsedUrl.hostname === 'youtu.be') {
        videoId = parsedUrl.pathname.substring(1);
      }

      // youtube.com/watch?v=VIDEO_ID
      if (parsedUrl.hostname === 'youtube.com' || parsedUrl.hostname === 'www.youtube.com') {
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
    videoBox.find('.video-box__banner, .video-box__controls').remove();
    video.play();
  });
});

/***/ }),

/***/ "./assets/js/components/navigation.js":
/*!********************************************!*\
  !*** ./assets/js/components/navigation.js ***!
  \********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _functions_breakpoint__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../functions/breakpoint */ "./assets/js/functions/breakpoint.js");

jQuery(document).ready(function ($) {
  "use strict";

  /**
   * Close mega menu
   */
  function closeMegaMenu() {
    $('.menu-item-has-children.active').removeClass('active').find('> .mega-menu').slideUp();
    $('body').removeClass('is-menu-open');

    // Remove outside click listener
    $(document).off('click.megaMenuOutside');
  }

  /**
   * Close mega menu when clicking a link inside it
   */
  $(document).on('click', '.mega-menu a', function () {
    closeMegaMenu();
  });

  /**
   * Enable outside click listener
   */
  function enableOutsideClick() {
    // Make sure we don't bind it twice
    $(document).off('click.megaMenuOutside');
    $(document).on('click.megaMenuOutside', function (e) {
      if ($(e.target).closest('.mega-menu').length || $(e.target).closest('.menu-item-has-children > .menu-item__link').length) {
        return;
      }
      closeMegaMenu();
    });
  }

  // keep aria-expanded of the burger button in sync with the menu state (the menu can be closed by other scripts too)
  const burger = document.querySelector('.icon-burger');
  if (burger) {
    const syncBurger = () => burger.setAttribute('aria-expanded', document.body.classList.contains('is-menu-open') ? 'true' : 'false');
    syncBurger();
    new MutationObserver(syncBurger).observe(document.body, {
      attributes: true,
      attributeFilter: ['class']
    });
  }

  /**
   * Toggle main menu
   */
  $('.icon-burger').on('click', function () {
    $('body').toggleClass('is-menu-open');
    if (!$('body').hasClass('is-menu-open')) {
      closeMegaMenu();
    }
  });

  /**
   * Close menu when clicking regular menu link
   */
  $('.main-menu li:not(.menu-item-has-children) > a').on('click', function () {
    closeMegaMenu();
  });

  /**
   * Autoclose mobile menu when increasing window width
   */
  function closeMobileMenu() {
    $('.main-menu .sub-menu, .footer-links .sub-menu').css('display', '');
    if ((0,_functions_breakpoint__WEBPACK_IMPORTED_MODULE_0__.minWidth)('lg')) {
      if ($('body').hasClass('is-menu-open')) {
        closeMegaMenu();
      }
    }
  }
  $(window).on('resize', function () {
    closeMobileMenu();
  });

  /**
   * Toggle mega menu
   */
  $(document).on('click', '.menu-item-has-children > .menu-item__link', function (e) {
    e.preventDefault();
    const $link = $(this);
    const $item = $link.closest('.menu-item-has-children');
    const $submenu = $item.find('> .mega-menu');

    /**
     * Close current menu
     */
    if ($item.hasClass('active')) {
      closeMegaMenu();

      /**
       * Open menu
       */
    } else {
      // Close other open mega menus
      $item.siblings('.menu-item-has-children').removeClass('active').find('> .mega-menu').slideUp();
      $item.addClass('active');
      $submenu.slideDown();
      $('body').addClass('is-menu-open');
      enableOutsideClick();
    }
  });
});

/***/ }),

/***/ "./assets/js/components/table-of-content.js":
/*!**************************************************!*\
  !*** ./assets/js/components/table-of-content.js ***!
  \**************************************************/
/***/ (function() {

jQuery(document).ready(function ($) {
  "use strict";

  const tocListWrapper = $('.table-of-content'),
    tocList = $('#table_of_content');
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
      headingTag = $heading.prop('tagName').toLowerCase(),
      headingId = 'heading-' + index;
    $heading.attr('id', headingId);
    const listItem = $('<li class="heading-' + headingTag + '">' + '<a href="#" data-heading="' + headingId + '">' + headingText + '</a>' + '</li>');
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
      target = $('#' + headingId);
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top - 100
      }, 500);
    }
  });
});

/***/ }),

/***/ "./assets/js/components/tabs.js":
/*!**************************************!*\
  !*** ./assets/js/components/tabs.js ***!
  \**************************************/
/***/ (function() {

jQuery(document).ready(function ($) {
  "use strict";

  /**
   * Tabs
   */
  $(document).on('click', '.js-tab-title', function () {
    const tabs = $(this).closest('.js-tabs'),
      item = $(this).data('item'),
      url = $(this).data('url');
    if (url && $(this).hasClass('is-active')) {
      window.open(url, '_blank', 'noopener,noreferrer');
      return;
    }
    if ('' !== item) {
      tabs.find('.js-tab-title').removeClass('is-active');
      $(this).addClass('is-active');
      tabs.find('.js-tab-content').removeClass('is-active');
      tabs.find('#' + item).addClass('is-active');
    }
  });
});

/***/ }),

/***/ "./assets/js/functions/breakpoint.js":
/*!*******************************************!*\
  !*** ./assets/js/functions/breakpoint.js ***!
  \*******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   minWidth: function() { return /* binding */ minWidth; }
/* harmony export */ });
/* harmony import */ var _vars__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../_vars */ "./assets/js/_vars.js");


// Like @include min(name) in SCSS (matchMedia measures like CSS): if (minWidth('lg')) { ... }
const minWidth = name => window.matchMedia(`(min-width: ${_vars__WEBPACK_IMPORTED_MODULE_0__["default"].bp[name]}px)`).matches;

/***/ }),

/***/ "./assets/js/functions/first-screen.js":
/*!*********************************************!*\
  !*** ./assets/js/functions/first-screen.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   inFirstScreen: function() { return /* binding */ inFirstScreen; }
/* harmony export */ });
// true if an element matching the selector is (partly) inside the first screen: inFirstScreen('.swiper')
const inFirstScreen = selector => [...document.querySelectorAll(selector)].some(el => el.getBoundingClientRect().top < window.innerHeight);

/***/ }),

/***/ "./assets/js/functions/load-modules.js":
/*!*********************************************!*\
  !*** ./assets/js/functions/load-modules.js ***!
  \*********************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   loadModules: function() { return /* binding */ loadModules; }
/* harmony export */ });
/**
 * Loads modules (dist/js/modules/) only on pages that contain their selector, after the page has loaded:
 * when the browser is idle, or earlier on the first user interaction. loadModules({ '.selector': () => import('../modules/name') })
 */

const loadModules = modules => {
  const events = ['scroll', 'click', 'touchstart', 'keydown'];
  let started = false;
  const start = () => {
    if (started) {
      return;
    }
    started = true;
    events.forEach(event => window.removeEventListener(event, start));
    Object.entries(modules).forEach(([selector, load]) => {
      if (document.querySelector(selector)) {
        load().catch(error => console.error(`Module for "${selector}" failed to load`, error));
      }
    });
  };

  // the first interaction loads the modules at once
  events.forEach(event => window.addEventListener(event, start, {
    once: true,
    passive: true
  }));

  // otherwise: after the "load" event, as soon as the browser is idle
  const whenIdle = () => 'requestIdleCallback' in window ? window.requestIdleCallback(start, {
    timeout: 2000
  }) : setTimeout(start, 200);
  if ('complete' === document.readyState) {
    whenIdle();
  } else {
    window.addEventListener('load', whenIdle, {
      once: true
    });
  }
};

/***/ }),

/***/ "./assets/js/functions/throttle.js":
/*!*****************************************!*\
  !*** ./assets/js/functions/throttle.js ***!
  \*****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   throttle: function() { return /* binding */ throttle; }
/* harmony export */ });
// Runs func at most once per delay (ms), the last call is not lost: window.addEventListener('resize', throttle(fn));

const throttle = (func, delay = 250) => {
  let isThrottled = false;
  let savedArgs = null;
  let savedThis = null;
  return function wrap(...args) {
    if (isThrottled) {
      // remember the latest call, it will be executed when the delay is over
      savedArgs = args;
      savedThis = this;
      return;
    }
    func.apply(this, args);
    isThrottled = true;
    setTimeout(() => {
      isThrottled = false;
      if (savedArgs) {
        const args = savedArgs;
        const context = savedThis;
        savedArgs = null;
        savedThis = null;
        wrap.apply(context, args);
      }
    }, delay);
  };
};

/***/ }),

/***/ "./assets/js/public-path.js":
/*!**********************************!*\
  !*** ./assets/js/public-path.js ***!
  \**********************************/
/***/ (function(__unused_webpack_module, __unused_webpack_exports, __webpack_require__) {

// URL of dist/js/ from PHP (itSettings.jsUrl): the on-demand modules load from the right place even when an optimization
// plugin (e.g. WP Rocket combine/minify) serves main.js from another folder. Without it webpack uses the location of main.js.
if (window.itSettings && window.itSettings.jsUrl) {
  __webpack_require__.p = window.itSettings.jsUrl;
}

/***/ }),

/***/ "./assets/js/vendors/jquery.nice-select.min.js":
/*!*****************************************************!*\
  !*** ./assets/js/vendors/jquery.nice-select.min.js ***!
  \*****************************************************/
/***/ (function() {

/*  jQuery Nice Select - v1.0
    https://github.com/hernansartorio/jquery-nice-select
    Made by Hernán Sartorio  */
!function (e) {
  e.fn.niceSelect = function (t) {
    function s(t) {
      t.after(e("<div></div>").addClass("nice-select").addClass(t.attr("class") || "").addClass(t.attr("disabled") ? "disabled" : "").attr("tabindex", t.attr("disabled") ? null : "0").html('<span class="current"></span><ul class="list"></ul>'));
      var s = t.next(),
        n = t.find("option"),
        i = t.find("option:selected");
      s.find(".current").html(i.data("display") || i.text()), n.each(function (t) {
        var n = e(this),
          i = n.data("display");
        s.find("ul").append(e("<li></li>").attr("data-value", n.val()).attr("data-display", i || null).addClass("option" + (n.is(":selected") ? " selected" : "") + (n.is(":disabled") ? " disabled" : "")).html(n.text()));
      });
    }
    if ("string" == typeof t) return "update" == t ? this.each(function () {
      var t = e(this),
        n = e(this).next(".nice-select"),
        i = n.hasClass("open");
      n.length && (n.remove(), s(t), i && t.next().trigger("click"));
    }) : "destroy" == t ? (this.each(function () {
      var t = e(this),
        s = e(this).next(".nice-select");
      s.length && (s.remove(), t.css("display", ""));
    }), 0 == e(".nice-select").length && e(document).off(".nice_select")) : console.log('Method "' + t + '" does not exist.'), this;
    this.hide(), this.each(function () {
      var t = e(this);
      t.next().hasClass("nice-select") || s(t);
    }), e(document).off(".nice_select"), e(document).on("click.nice_select", ".nice-select", function (t) {
      var s = e(this);
      e(".nice-select").not(s).removeClass("open"), s.toggleClass("open"), s.hasClass("open") ? (s.find(".option"), s.find(".focus").removeClass("focus"), s.find(".selected").addClass("focus")) : s.focus();
    }), e(document).on("click.nice_select", function (t) {
      0 === e(t.target).closest(".nice-select").length && e(".nice-select").removeClass("open").find(".option");
    }), e(document).on("click.nice_select", ".nice-select .option:not(.disabled)", function (t) {
      var s = e(this),
        n = s.closest(".nice-select");
      n.find(".selected").removeClass("selected"), s.addClass("selected");
      var i = s.data("display") || s.text();
      n.find(".current").text(i), n.prev("select").val(s.data("value")).trigger("change");
    }), e(document).on("keydown.nice_select", ".nice-select", function (t) {
      var s = e(this),
        n = e(s.find(".focus") || s.find(".list .option.selected"));
      if (32 == t.keyCode || 13 == t.keyCode) return s.hasClass("open") ? n.trigger("click") : s.trigger("click"), !1;
      if (40 == t.keyCode) {
        if (s.hasClass("open")) {
          var i = n.nextAll(".option:not(.disabled)").first();
          i.length > 0 && (s.find(".focus").removeClass("focus"), i.addClass("focus"));
        } else s.trigger("click");
        return !1;
      }
      if (38 == t.keyCode) {
        if (s.hasClass("open")) {
          var l = n.prevAll(".option:not(.disabled)").first();
          l.length > 0 && (s.find(".focus").removeClass("focus"), l.addClass("focus"));
        } else s.trigger("click");
        return !1;
      }
      if (27 == t.keyCode) s.hasClass("open") && s.trigger("click");else if (9 == t.keyCode && s.hasClass("open")) return !1;
    });
    var n = document.createElement("a").style;
    return n.cssText = "pointer-events:auto", "auto" !== n.pointerEvents && e("html").addClass("no-csspointerevents"), this;
  };
}(jQuery);

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		if (!(moduleId in __webpack_modules__)) {
/******/ 			delete __webpack_module_cache__[moduleId];
/******/ 			var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function() { return module['default']; } :
/******/ 			function() { return module; };
/******/ 		__webpack_require__.d(getter, { a: getter });
/******/ 		return getter;
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	// define getter/value functions for harmony exports
/******/ 	__webpack_require__.d = function(exports, definition) {
/******/ 		for(var key in definition) {
/******/ 			if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 				Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 			}
/******/ 		}
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/ensure chunk */
/******/ 	__webpack_require__.f = {};
/******/ 	// This file contains only the entry chunk.
/******/ 	// The chunk loading function for additional chunks
/******/ 	__webpack_require__.e = function(chunkId) {
/******/ 		var promises = [];
/******/ 		__webpack_require__.f.j(chunkId, promises);
/******/ 		return Promise.all(promises);
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/get javascript chunk filename */
/******/ 	// This function allow to reference async chunks
/******/ 	__webpack_require__.u = function(chunkId) { return "modules/" + chunkId + "." + {"vendors-node_modules_swiper_modules_index_mjs-node_modules_swiper_swiper_mjs":"2a9d4bf6","slider":"4e32018f","vendors-node_modules_fancyapps_ui_dist_fancybox_esm_js":"71274d69","lightbox":"769adb94"}[chunkId] + ".js"; };
/******/ 	
/******/ 	/* webpack/runtime/global */
/******/ 	__webpack_require__.g = (function() {
/******/ 		if (typeof globalThis === 'object') return globalThis;
/******/ 		try {
/******/ 			return this || new Function('return this')();
/******/ 		} catch (e) {
/******/ 			if (typeof window === 'object') return window;
/******/ 		}
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); };
/******/ 	
/******/ 	/* webpack/runtime/load script */
/******/ 	!function() {
/******/ 		var inProgress = {};
/******/ 		var dataWebpackPrefix = "iag:";
/******/ 		// loadScript function to load a script via script tag
/******/ 		__webpack_require__.l = function(url, done, key, chunkId) {
/******/ 			if(inProgress[url]) { inProgress[url].push(done); return; }
/******/ 			var script, needAttach;
/******/ 			if(key !== undefined) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				for(var i = 0; i < scripts.length; i++) {
/******/ 					var s = scripts[i];
/******/ 					if(s.getAttribute("src") == url || s.getAttribute("data-webpack") == dataWebpackPrefix + key) { script = s; break; }
/******/ 				}
/******/ 			}
/******/ 			if(!script) {
/******/ 				needAttach = true;
/******/ 				script = document.createElement('script');
/******/ 		
/******/ 				script.charset = 'utf-8';
/******/ 				if (__webpack_require__.nc) {
/******/ 					script.setAttribute("nonce", __webpack_require__.nc);
/******/ 				}
/******/ 				script.setAttribute("data-webpack", dataWebpackPrefix + key);
/******/ 		
/******/ 				script.src = url;
/******/ 			}
/******/ 			inProgress[url] = [done];
/******/ 			var onScriptComplete = function(prev, event) {
/******/ 				// avoid mem leaks in IE.
/******/ 				script.onerror = script.onload = null;
/******/ 				clearTimeout(timeout);
/******/ 				var doneFns = inProgress[url];
/******/ 				delete inProgress[url];
/******/ 				script.parentNode && script.parentNode.removeChild(script);
/******/ 				doneFns && doneFns.forEach(function(fn) { return fn(event); });
/******/ 				if(prev) return prev(event);
/******/ 			}
/******/ 			var timeout = setTimeout(onScriptComplete.bind(null, undefined, { type: 'timeout', target: script }), 120000);
/******/ 			script.onerror = onScriptComplete.bind(null, script.onerror);
/******/ 			script.onload = onScriptComplete.bind(null, script.onload);
/******/ 			needAttach && document.head.appendChild(script);
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ 	
/******/ 	/* webpack/runtime/publicPath */
/******/ 	!function() {
/******/ 		var scriptUrl;
/******/ 		if (__webpack_require__.g.importScripts) scriptUrl = __webpack_require__.g.location + "";
/******/ 		var document = __webpack_require__.g.document;
/******/ 		if (!scriptUrl && document) {
/******/ 			if (document.currentScript && document.currentScript.tagName.toUpperCase() === 'SCRIPT')
/******/ 				scriptUrl = document.currentScript.src;
/******/ 			if (!scriptUrl) {
/******/ 				var scripts = document.getElementsByTagName("script");
/******/ 				if(scripts.length) {
/******/ 					var i = scripts.length - 1;
/******/ 					while (i > -1 && (!scriptUrl || !/^https?:/.test(scriptUrl))) scriptUrl = scripts[i--].src;
/******/ 				}
/******/ 			}
/******/ 		}
/******/ 		// When supporting browsers where an automatic publicPath is not supported you must specify an output.publicPath manually via configuration
/******/ 		// or pass an empty string ("") and set the __webpack_public_path__ variable from your code to use your own logic.
/******/ 		if (!scriptUrl) throw new Error("Automatic publicPath is not supported in this browser");
/******/ 		scriptUrl = scriptUrl.replace(/^blob:|[?#].*$/g, "").replace(/\/[^/]+$/, "/");
/******/ 		__webpack_require__.p = scriptUrl;
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"main": 0
/******/ 		};
/******/ 		
/******/ 		__webpack_require__.f.j = function(chunkId, promises) {
/******/ 				// JSONP chunk loading for javascript
/******/ 				var installedChunkData = __webpack_require__.o(installedChunks, chunkId) ? installedChunks[chunkId] : undefined;
/******/ 				if(installedChunkData !== 0) { // 0 means "already installed".
/******/ 		
/******/ 					// a Promise means "currently loading".
/******/ 					if(installedChunkData) {
/******/ 						promises.push(installedChunkData[2]);
/******/ 					} else {
/******/ 						if(true) { // all chunks have JS
/******/ 							// setup Promise in chunk cache
/******/ 							var promise = new Promise(function(resolve, reject) { installedChunkData = installedChunks[chunkId] = [resolve, reject]; });
/******/ 							promises.push(installedChunkData[2] = promise);
/******/ 		
/******/ 							// create error before stack unwound to get useful stacktrace later
/******/ 							var error = new Error();
/******/ 							var loadingEnded = function(event) {
/******/ 								if(__webpack_require__.o(installedChunks, chunkId)) {
/******/ 									installedChunkData = installedChunks[chunkId];
/******/ 									if(installedChunkData !== 0) installedChunks[chunkId] = undefined;
/******/ 									if(installedChunkData) {
/******/ 										var errorType = event && (event.type === 'load' ? 'missing' : event.type);
/******/ 										var realSrc = event && event.target && event.target.src;
/******/ 										error.message = 'Loading chunk ' + chunkId + ' failed.\n(' + errorType + ': ' + realSrc + ')';
/******/ 										error.name = 'ChunkLoadError';
/******/ 										error.type = errorType;
/******/ 										error.request = realSrc;
/******/ 										error.event = event;
/******/ 										installedChunkData[1](error);
/******/ 									}
/******/ 								}
/******/ 							};
/******/ 							__webpack_require__.l(__webpack_require__.p + __webpack_require__.u(chunkId), loadingEnded, "chunk-" + chunkId, chunkId);
/******/ 						}
/******/ 					}
/******/ 				}
/******/ 		};
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		// no on chunks loaded
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 		
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkiag"] = self["webpackChunkiag"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be in strict mode.
!function() {
"use strict";
/*!***************************!*\
  !*** ./assets/js/main.js ***!
  \***************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _public_path__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./public-path */ "./assets/js/public-path.js");
/* harmony import */ var _public_path__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_public_path__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _functions_load_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./functions/load-modules */ "./assets/js/functions/load-modules.js");
/* harmony import */ var _functions_first_screen__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./functions/first-screen */ "./assets/js/functions/first-screen.js");
/* harmony import */ var _components_custom__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/_custom */ "./assets/js/components/_custom.js");
/* harmony import */ var _components_adminbar__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/adminbar */ "./assets/js/components/adminbar.js");
/* harmony import */ var _components_adminbar__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_components_adminbar__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _components_header_scrolled__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/header-scrolled */ "./assets/js/components/header-scrolled.js");
/* harmony import */ var _components_navigation__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/navigation */ "./assets/js/components/navigation.js");
/* harmony import */ var _components_table_of_content__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./components/table-of-content */ "./assets/js/components/table-of-content.js");
/* harmony import */ var _components_table_of_content__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(_components_table_of_content__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var _components_accordion__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./components/accordion */ "./assets/js/components/accordion.js");
/* harmony import */ var _components_accordion__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(_components_accordion__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var _components_modal__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./components/modal */ "./assets/js/components/modal.js");
/* harmony import */ var _components_modal__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(_components_modal__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var _components_tabs__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./components/tabs */ "./assets/js/components/tabs.js");
/* harmony import */ var _components_tabs__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(_components_tabs__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var _components_lightbox_trigger__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./components/lightbox-trigger */ "./assets/js/components/lightbox-trigger.js");
/* harmony import */ var _components_lightbox_trigger__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(_components_lightbox_trigger__WEBPACK_IMPORTED_MODULE_11__);
// Webpack entry. Components: always loaded. Modules: separate files, loaded only on pages with their selector
 // first: tells webpack where the module files are











const slider = () => Promise.all(/*! import() | slider */[__webpack_require__.e("vendors-node_modules_swiper_modules_index_mjs-node_modules_swiper_swiper_mjs"), __webpack_require__.e("slider")]).then(__webpack_require__.bind(__webpack_require__, /*! ./modules/slider */ "./assets/js/modules/slider.js"));

// a slider in the first screen starts at once (no visible jump), the others when the browser is idle
if ((0,_functions_first_screen__WEBPACK_IMPORTED_MODULE_2__.inFirstScreen)('.swiper')) {
  slider().catch(error => console.error('Slider failed to load', error));
}
;(0,_functions_load_modules__WEBPACK_IMPORTED_MODULE_1__.loadModules)({
  '.swiper': slider,
  '[data-fancybox]': () => Promise.all(/*! import() | lightbox */[__webpack_require__.e("vendors-node_modules_fancyapps_ui_dist_fancybox_esm_js"), __webpack_require__.e("lightbox")]).then(__webpack_require__.bind(__webpack_require__, /*! ./modules/lightbox */ "./assets/js/modules/lightbox.js"))
});
}();
/******/ })()
;
//# sourceMappingURL=main.js.map