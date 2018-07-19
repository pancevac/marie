window.Vue = require('vue');
import LazyImages from './components/lazy-images';

Vue.component('my-header', require('./components/Header.vue'));
Vue.component('tab-bar', require('./components/TabBar.vue'));
Vue.component('simple-carousel', require('./components/SimpleCarousel.vue'));
Vue.component('search-widget', require('./components/SearchWidget.vue'));
Vue.component('slide', require('./components/Slide.vue'));

const mc = new Vue({
  el: '#app',
});

LazyImages.init();
