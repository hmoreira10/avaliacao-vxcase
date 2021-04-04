import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import Layout from './../components/layouts/layout'
import Dashboard from './../components/dashboard.vue'
import CreateSale from './../components/partials/CreateSale.vue'

const routes = [
    {
        path: '/',
        name: 'layout',
        component: Layout,
        children: [
            {
                path: '',
                name: 'dashboard',
                component: Dashboard
            },
            {
                path: 'create',
                name: 'create',
                component: CreateSale
            }
        ],        
    }
];

export const router = new VueRouter({
    mode: 'history',
    routes
});
