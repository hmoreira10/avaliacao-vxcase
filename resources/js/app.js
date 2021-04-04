/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
window.Vue = require('vue');

// setup vue currency filter
import VueCurrencyFilter from 'vue-currency-filter'
Vue.use(VueCurrencyFilter,
{
  symbol : 'R$',
  thousandsSeparator: '.',
  fractionCount: 2,
  fractionSeparator: ',',
  symbolPosition: 'front',
  symbolSpacing: true
})
import Buefy from 'buefy'
Vue.use(Buefy)
import {
    router
} from './router/index';

import {
    store
} from './vuex/store';

const app = new Vue({
    el: '#app',
    store,
    router: router
});
