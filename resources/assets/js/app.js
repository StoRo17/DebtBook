import './bootstrap';
import router from './routes';
import SideNav from './views/SideNav.vue';
import SignButton from './components/SignButton.vue';
import Header from './views/Header.vue';


if (document.querySelector('#app')) {
    Vue.component('header-nav', Header);
    Vue.component('sign-button', SignButton);
    Vue.component('side-nav', SideNav);

    const app = new Vue({
        el: '#app',

        router
    });
}
