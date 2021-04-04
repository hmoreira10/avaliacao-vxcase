import Vue from 'vue';
import Vuex from 'vuex';

import sale from './modules/sale'
import product from './modules/product'

Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        sale,
        product
    }
});
