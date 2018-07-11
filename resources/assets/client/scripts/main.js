import LazyImages from './components/lazy-images';
window.Vue = require('vue');

Vue.component('my-header', require('./components/Header.vue'));
Vue.component('tab-bar', require('./components/TabBar.vue'));

const mc = new Vue({
  el: '#app',
});

LazyImages.init();
