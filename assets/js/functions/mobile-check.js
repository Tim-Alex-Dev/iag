import vars from '../_vars';

/**
 * Check OS on mobiles
 * @returns {string}
 *
 * example: console.log(mobileCheck());
 */

export const mobileCheck = () => {
  const userAgent = navigator.userAgent || navigator.vendor || window.opera;

  if (/android/i.test(userAgent)) {
    vars.htmlEl.classList.add('is-android');
    return "Android";
  }

  if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
    vars.htmlEl.classList.add('is-ios');
    return "iOS";
  }

  return "unknown";
};
