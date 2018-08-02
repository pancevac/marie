window.Vue = require('vue');
import LazyImages from './components/lazy-images';

Vue.component('toggler', require('./components/Toggler.vue'));
Vue.component('tab-bar', require('./components/TabBar.vue'));
Vue.component('simple-carousel', require('./components/SimpleCarousel.vue'));
Vue.component('search-widget', require('./components/SearchWidget.vue'));
Vue.component('slide', require('./components/Slide.vue'));
Vue.component('temporary-drawer', require('./components/Drawer.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('collapsible', require('./components/Collapsible.vue'));

const mc = new Vue({
  el: '#app',
});

LazyImages.init();
