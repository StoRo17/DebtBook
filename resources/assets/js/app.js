import './bootstrap';
import router from './appRoutes';
import Header from './views/Header.vue';
import SideNav from './views/SideNav.vue';


if (document.querySelector('#app')) {
    Vue.component('header-nav', Header);
    Vue.component('side-nav', SideNav);

    const app = new Vue({
        el: '#app',

        router
    });
}
