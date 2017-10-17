import './bootstrap';
import router from './startPageRoutes';
import Header from './views/Header.vue';
import SignButton from './components/SignButton.vue';


if (document.querySelector('#start-page')) {
    Vue.component('header-nav', Header);
    Vue.component('sign-button', SignButton);

    const startPage = new Vue({
        el: '#start-page',
        router
    });
}
