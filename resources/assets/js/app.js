import './bootstrap';
import router from './routes';
import Header from './views/Header.vue';
import SideNav from './views/SideNav.vue';
import SignButton from './components/SignButton.vue';


if (document.querySelector('#app')) {
    Vue.component('sign-button', SignButton);
    Vue.component('header-nav', Header);
    Vue.component('side-nav', SideNav);

    const app = new Vue({
        el: '#app',

        router
    });
}
