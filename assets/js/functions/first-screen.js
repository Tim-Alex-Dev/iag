// true if an element matching the selector is (partly) inside the first screen: inFirstScreen('.swiper')
export const inFirstScreen = (selector) => [...document.querySelectorAll(selector)].some(el => el.getBoundingClientRect().top < window.innerHeight);
