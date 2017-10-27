import './bootstrap';
import router from './startPageRoutes';
import Header from './views/Header.vue';


if (document.querySelector('#start-page')) {
    Vue.component('header-nav', Header);

    const startPage = new Vue({
        el: '#start-page',
        router
    });
}
