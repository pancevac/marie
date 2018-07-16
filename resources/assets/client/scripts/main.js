window.Vue = require('vue');
import LazyImages from './components/lazy-images';
import {createCarousel} from './components/carousel';
import {parseString} from './utils';

Vue.component('my-header', require('./components/Header.vue'));
Vue.component('tab-bar', require('./components/TabBar.vue'));

const mc = new Vue({
  el: '#app',
});

LazyImages.init();

const carousel = createCarousel('.js-carousel');
Array.from(document.querySelectorAll('.js-carousel'))
  .map((el) => {
    const config = parseString(el.dataset.config);
    console.log(config)
    return createCarousel(el, config);
  })