import LazyImages from './components/lazy-images';
import Siema from './components/siema';
window.Vue = require('vue');

Vue.component('my-header', require('./components/Header.vue'));
Vue.component('tab-bar', require('./components/TabBar.vue'));

const mc = new Vue({
  el: '#app',
});

LazyImages.init();

const carousel = new Siema({
  selector: '.js-carousel',
  perPage: 5,
});
