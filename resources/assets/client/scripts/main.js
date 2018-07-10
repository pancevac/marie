import LazyImages from './components/lazy-images';
window.Vue = require('vue');

Vue.component('my-header', require('./components/Header.vue'));

const mc = new Vue({
  el: '#app',
});

LazyImages.init();
