
require('./bootstrap');

// import css and boorstrap vue
import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'vue-cal/dist/vuecal.css';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);
Vue.use(BootstrapVue);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';

Vue.use(VueAxios, axios);

import HomeComponent from './components/HomeComponent.vue';

const routes = [
    {
        name: 'home',
        path: '/',
        component: HomeComponent
    }
];

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');