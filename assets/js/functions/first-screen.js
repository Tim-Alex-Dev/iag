// true if a visible element matching the selector is (partly) inside the first screen: inFirstScreen('.swiper').
// Hidden elements (display: none, e.g. inactive tabs, or visibility: hidden, e.g. a closed modal) do not count.
export const isShown = el => (el.checkVisibility ? el.checkVisibility({visibilityProperty: true}) : el.getClientRects().length > 0);

export const inFirstScreen = (selector) => [...document.querySelectorAll(selector)].some(el => isShown(el) && el.getBoundingClientRect().top < window.innerHeight);
