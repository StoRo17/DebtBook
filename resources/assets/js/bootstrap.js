import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import axios from 'axios';
import Lang from  './localization/lang';


window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(Vuex);

window.axios = axios;
window.Lang = Lang;

Vue.filter('trans', (...args) => {
    return Lang.get(...args);
});

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
