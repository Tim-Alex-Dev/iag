// Webpack entry. Components: always loaded. Modules: separate files, loaded only on pages with their selector
import {loadModules} from './functions/load-modules';

import './components/_custom';
import './components/adminbar';
import './components/header-scrolled';
import './components/navigation';
import './components/table-of-content';
import './components/accordion';
import './components/modal';
import './components/tabs';
import './components/lightbox-trigger';

loadModules({
	'.swiper': () => import(/* webpackChunkName: "slider" */ './modules/slider'),
	'[data-fancybox]': () => import(/* webpackChunkName: "lightbox" */ './modules/lightbox'),
});
