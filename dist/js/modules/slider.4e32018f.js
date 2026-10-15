"use strict";
(self["webpackChunkiag"] = self["webpackChunkiag"] || []).push([["slider"],{

/***/ "./assets/js/modules/slider.js":
/*!*************************************!*\
  !*** ./assets/js/modules/slider.js ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.mjs");
/* harmony import */ var swiper_modules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper/modules */ "./node_modules/swiper/modules/index.mjs");

 // only the used modules (+ their CSS in 3-vendors/_swiper-bundle.scss)

jQuery(document).ready(function ($) {
  "use strict";

  /**
   * Sliders
   */
  document.querySelectorAll('.m-experience__swiper').forEach(slider => {
    new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](slider, {
      modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Navigation, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Pagination, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Autoplay, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.A11y],
      loop: false,
      spaceBetween: 24,
      slidesPerView: 1,
      breakpoints: {
        1024: {
          slidesPerView: 2,
          slidesPerGroup: 2
        }
      },
      speed: 1000,
      pagination: {
        el: slider.querySelector('.m-experience__swiper-pagination'),
        dynamicBullets: true,
        clickable: true
      }
    });
  });

  // Simple Slider and Stars modules share the same slider settings
  ['m-slider', 'm-stars'].forEach(module => {
    document.querySelectorAll('.' + module + '__swiper').forEach(slider => {
      const wrapper = slider.closest('.' + module);
      new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](slider, {
        modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Navigation, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Pagination, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Autoplay, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.A11y],
        loop: false,
        spaceBetween: 24,
        slidesPerView: 1,
        breakpoints: {
          640: {
            slidesPerView: 2
          },
          1024: {
            slidesPerView: 4
          }
        },
        speed: 1000,
        navigation: {
          nextEl: wrapper.querySelector('.' + module + '__swiper-button-next'),
          prevEl: wrapper.querySelector('.' + module + '__swiper-button-prev')
        }
      });
    });
  });

  // Partnership logos: two endless rows
  document.querySelectorAll('.m-partnership__swiper-top, .m-partnership__swiper-bottom').forEach(slider => {
    if (slider.swiper) {
      return;
    }
    new swiper__WEBPACK_IMPORTED_MODULE_0__["default"](slider, {
      modules: [swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Navigation, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Pagination, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.Autoplay, swiper_modules__WEBPACK_IMPORTED_MODULE_1__.A11y],
      slidesPerView: 'auto',
      spaceBetween: 20,
      loop: true,
      speed: 6000,
      allowTouchMove: false,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
        pauseOnMouseEnter: false
      }
    });
  });
});

/***/ })

}]);
//# sourceMappingURL=slider.4e32018f.js.map