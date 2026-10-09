// Webpack entry. Components: always loaded. Modules: separate files, loaded only on pages with their selector
import {loadModules} from './functions/load-modules';
import {inFirstScreen} from './functions/first-screen';

import './components/_custom';
import './components/adminbar';
import './components/header-scrolled';
import './components/navigation';
import './components/table-of-content';
import './components/accordion';
import './components/modal';
import './components/tabs';
import './components/lightbox-trigger';

const slider = () => import(/* webpackChunkName: "slider" */ './modules/slider');

// a slider in the first screen starts at once (no visible jump), the others when the browser is idle
if (inFirstScreen('.swiper')) {
	slider().catch(error => console.error('Slider failed to load', error));
}

loadModules({
	'.swiper': slider,
	'[data-fancybox]': () => import(/* webpackChunkName: "lightbox" */ './modules/lightbox'),
});
